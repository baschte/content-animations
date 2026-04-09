#!/usr/bin/env php
<?php

declare(strict_types=1);

/*
 * This file is part of the package baschte/content-animations.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

final class ReleasePreparer
{
    private const CATEGORY_MAP = [
        'FEATURE' => 'features',
        'BUGFIX' => 'bugfix',
        'TASK' => 'tasks',
        'SECURITY' => 'security',
        'BREAKING' => 'breaking',
    ];

    private const CATEGORY_ORDER = [
        'features',
        'bugfix',
        'tasks',
        'breaking',
        'security',
        'uncategorized',
    ];

    private const MARKDOWN_TITLES = [
        'features' => 'FEATURES',
        'bugfix' => 'BUGFIX',
        'tasks' => 'TASKS',
        'breaking' => 'BREAKING',
        'security' => 'SECURITY',
        'uncategorized' => 'UNCATEGORIZED',
    ];

    private const RST_TITLES = [
        'features' => 'Features',
        'bugfix' => 'Bugfixes',
        'tasks' => 'Tasks',
        'breaking' => 'Breaking Changes',
        'security' => 'Security',
        'uncategorized' => 'Uncategorized',
    ];

    private string $projectRoot;
    private bool $dryRun = false;
    private string $version;
    private string $date;

    public function __construct(string $projectRoot)
    {
        $this->projectRoot = $projectRoot;
    }

    public function run(array $argv): int
    {
        try {
            $this->parseArguments($argv);

            $lastTag = $this->detectLastTag();
            $commits = $this->collectCommits($lastTag);
            $groupedCommits = $this->categorizeCommits($commits);

            $files = [
                'composer.json' => $this->updateComposerJson($this->readFile('composer.json')),
                'ext_emconf.php' => $this->updateExtEmconf($this->readFile('ext_emconf.php')),
                'Documentation/Settings.cfg' => $this->updateSettingsCfg($this->readFile('Documentation/Settings.cfg')),
                'ChangeLog.md' => $this->updateMarkdownChangelog($this->readFile('ChangeLog.md'), $groupedCommits),
                'Documentation/ChangeLog/Index.rst' => $this->updateRstChangelog($this->readFile('Documentation/ChangeLog/Index.rst'), $groupedCommits),
            ];

            if ($this->dryRun) {
                $this->printDryRun($lastTag, $groupedCommits, $files);
                return 0;
            }

            foreach ($files as $path => $content) {
                $this->writeFile($path, $content);
            }

            fwrite(STDOUT, sprintf('Prepared release %s (%s)%s', $this->version, $this->date, PHP_EOL));
            if ($lastTag !== null) {
                fwrite(STDOUT, sprintf('Collected changelog entries from %s..HEAD%s', $lastTag, PHP_EOL));
            }

            return 0;
        } catch (RuntimeException $exception) {
            fwrite(STDERR, $exception->getMessage() . PHP_EOL);
            return 1;
        }
    }

    private function parseArguments(array $argv): void
    {
        array_shift($argv);

        if ($argv === []) {
            throw new RuntimeException('Usage: php Build/release-prepare.php <version> [--date=YYYY-MM-DD] [--dry-run]');
        }

        $version = null;
        $date = date('Y-m-d');

        foreach ($argv as $argument) {
            if ($argument === '--dry-run') {
                $this->dryRun = true;
                continue;
            }

            if (str_starts_with($argument, '--date=')) {
                $date = substr($argument, 7);
                continue;
            }

            if (str_starts_with($argument, '--')) {
                throw new RuntimeException(sprintf('Unknown option: %s', $argument));
            }

            if ($version !== null) {
                throw new RuntimeException('Only one target version may be provided.');
            }

            $version = $argument;
        }

        if ($version === null || !preg_match('/^\d+\.\d+\.\d+$/', $version)) {
            throw new RuntimeException('Version must use semantic version format, for example 2.6.1.');
        }

        $dateTime = DateTimeImmutable::createFromFormat('Y-m-d', $date);
        if (!$dateTime || $dateTime->format('Y-m-d') !== $date) {
            throw new RuntimeException('Date must use the format YYYY-MM-DD.');
        }

        $this->version = $version;
        $this->date = $date;
    }

    private function detectLastTag(): ?string
    {
        exec('git describe --tags --abbrev=0 2>/dev/null', $output, $exitCode);

        if ($exitCode !== 0 || $output === []) {
            return null;
        }

        return trim($output[0]);
    }

    /**
     * @return list<string>
     */
    private function collectCommits(?string $lastTag): array
    {
        $command = 'git log ';
        if ($lastTag !== null) {
            $command .= escapeshellarg($lastTag . '..HEAD') . ' ';
        }
        $command .= '--pretty=format:%s';

        exec($command, $output, $exitCode);

        if ($exitCode !== 0) {
            throw new RuntimeException('Unable to collect commits from git history.');
        }

        $commits = [];
        foreach ($output as $line) {
            $subject = trim($line);
            if ($subject === '' || str_starts_with($subject, 'Merge ')) {
                continue;
            }
            $commits[] = $subject;
        }

        if ($commits === []) {
            throw new RuntimeException('No release-relevant commits found since the last tag.');
        }

        return array_values(array_unique($commits));
    }

    /**
     * @param list<string> $commits
     * @return array<string, list<string>>
     */
    private function categorizeCommits(array $commits): array
    {
        $grouped = [];
        foreach (self::CATEGORY_ORDER as $category) {
            $grouped[$category] = [];
        }

        foreach ($commits as $commit) {
            $grouped[$this->determineCategory($commit)][] = $commit;
        }

        return $grouped;
    }

    private function determineCategory(string $commit): string
    {
        if (str_contains($commit, '[!!!]') || str_contains($commit, '[BREAKING]')) {
            return 'breaking';
        }

        if (preg_match('/\[([A-Z]+)\]/', $commit, $matches) === 1) {
            $token = $matches[1];
            if (isset(self::CATEGORY_MAP[$token])) {
                return self::CATEGORY_MAP[$token];
            }
        }

        return 'uncategorized';
    }

    private function updateComposerJson(string $content): string
    {
        $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        if (!is_array($data)) {
            throw new RuntimeException('composer.json could not be parsed as an object.');
        }

        $data['version'] = $this->version;
        $data['scripts']['release:prepare'] = ['php Build/release-prepare.php'];

        $encoded = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
        if (!is_string($encoded)) {
            throw new RuntimeException('composer.json could not be encoded.');
        }

        return str_replace('    ', "\t", $encoded) . PHP_EOL;
    }

    private function updateExtEmconf(string $content): string
    {
        $updated = preg_replace(
            "/'version'\s*=>\s*'[^']+'/",
            sprintf("'version' => '%s'", $this->version),
            $content,
            1
        );

        if (!is_string($updated)) {
            throw new RuntimeException('Unable to update ext_emconf.php version.');
        }

        return $updated;
    }

    private function updateSettingsCfg(string $content): string
    {
        [$major, $minor] = explode('.', $this->version);
        $shortVersion = $major . '.' . $minor;

        $updated = preg_replace('/^version\s*=\s*.+$/m', sprintf('version = %s', $shortVersion), $content, 1);
        if (!is_string($updated)) {
            throw new RuntimeException('Unable to update Documentation/Settings.cfg version.');
        }

        $updated = preg_replace('/^release\s*=\s*.+$/m', sprintf('release = %s', $this->version), $updated, 1);
        if (!is_string($updated)) {
            throw new RuntimeException('Unable to update Documentation/Settings.cfg release.');
        }

        return $updated;
    }

    /**
     * @param array<string, list<string>> $groupedCommits
     */
    private function updateMarkdownChangelog(string $content, array $groupedCommits): string
    {
        $heading = sprintf('## %s - %s', $this->version, $this->date);
        if (str_contains($content, $heading)) {
            throw new RuntimeException(sprintf('ChangeLog.md already contains release %s.', $this->version));
        }

        $section = $heading . PHP_EOL . $this->renderMarkdownSections($groupedCommits) . PHP_EOL . PHP_EOL;

        return $this->prependBeforeFirstReleaseHeading(
            $content,
            '/^##\s+\d+\.\d+\.\d+\s+-\s+\d{4}-\d{2}-\d{2}$/m',
            $section
        );
    }

    /**
     * @param array<string, list<string>> $groupedCommits
     */
    private function updateRstChangelog(string $content, array $groupedCommits): string
    {
        $heading = sprintf('%s - %s', $this->version, $this->date);
        if (str_contains($content, $heading)) {
            throw new RuntimeException(sprintf('Documentation/ChangeLog/Index.rst already contains release %s.', $this->version));
        }

        $section = $heading . PHP_EOL;
        $section .= str_repeat('=', strlen($heading)) . PHP_EOL . PHP_EOL;
        $section .= $this->renderRstSections($groupedCommits) . PHP_EOL . PHP_EOL;

        return $this->prependBeforeFirstReleaseHeading(
            $content,
            '/^\d+\.\d+\.\d+\s+-\s+\d{4}-\d{2}-\d{2}$/m',
            $section
        );
    }

    /**
     * @param array<string, list<string>> $groupedCommits
     */
    private function renderMarkdownSections(array $groupedCommits): string
    {
        $parts = [];
        foreach (self::CATEGORY_ORDER as $category) {
            if ($groupedCommits[$category] === []) {
                continue;
            }

            $lines = ['### ' . self::MARKDOWN_TITLES[$category]];
            foreach ($groupedCommits[$category] as $entry) {
                $lines[] = '- ' . $entry;
            }
            $parts[] = implode(PHP_EOL, $lines);
        }

        return implode(PHP_EOL . PHP_EOL, $parts);
    }

    /**
     * @param array<string, list<string>> $groupedCommits
     */
    private function renderRstSections(array $groupedCommits): string
    {
        $parts = [];
        foreach (self::CATEGORY_ORDER as $category) {
            if ($groupedCommits[$category] === []) {
                continue;
            }

            $title = self::RST_TITLES[$category];
            $lines = [$title, str_repeat('^', strlen($title))];
            foreach ($groupedCommits[$category] as $entry) {
                $lines[] = '- ' . $entry;
            }
            $parts[] = implode(PHP_EOL, $lines);
        }

        return implode(PHP_EOL . PHP_EOL, $parts);
    }

    private function prependBeforeFirstReleaseHeading(string $content, string $pattern, string $section): string
    {
        if (preg_match($pattern, $content, $matches, PREG_OFFSET_CAPTURE) !== 1) {
            throw new RuntimeException('Could not find the insertion point for the changelog update.');
        }

        $offset = $matches[0][1];

        return substr($content, 0, $offset) . $section . substr($content, $offset);
    }

    /**
     * @param array<string, list<string>> $groupedCommits
     * @param array<string, string> $files
     */
    private function printDryRun(?string $lastTag, array $groupedCommits, array $files): void
    {
        fwrite(STDOUT, sprintf('Dry run for release %s (%s)%s', $this->version, $this->date, PHP_EOL));
        fwrite(STDOUT, sprintf('Last tag: %s%s', $lastTag ?? 'none', PHP_EOL));

        foreach (self::CATEGORY_ORDER as $category) {
            if ($groupedCommits[$category] === []) {
                continue;
            }

            fwrite(STDOUT, self::MARKDOWN_TITLES[$category] . ':' . PHP_EOL);
            foreach ($groupedCommits[$category] as $entry) {
                fwrite(STDOUT, sprintf('  - %s%s', $entry, PHP_EOL));
            }
        }

        fwrite(STDOUT, PHP_EOL . 'Files to update:' . PHP_EOL);
        foreach (array_keys($files) as $path) {
            fwrite(STDOUT, sprintf('  - %s%s', $path, PHP_EOL));
        }
    }

    private function readFile(string $relativePath): string
    {
        $content = file_get_contents($this->projectRoot . '/' . $relativePath);
        if ($content === false) {
            throw new RuntimeException(sprintf('Unable to read %s.', $relativePath));
        }

        return $content;
    }

    private function writeFile(string $relativePath, string $content): void
    {
        if (file_put_contents($this->projectRoot . '/' . $relativePath, $content) === false) {
            throw new RuntimeException(sprintf('Unable to write %s.', $relativePath));
        }
    }
}

$preparer = new ReleasePreparer(dirname(__DIR__));

exit($preparer->run($argv));
