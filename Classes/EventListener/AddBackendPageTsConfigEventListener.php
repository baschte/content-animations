<?php

declare(strict_types=1);

/*
 * This file is part of the package baschte/content-animations.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Baschte\ContentAnimations\EventListener;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\TypoScript\IncludeTree\Event\BeforeLoadedPageTsConfigEvent;
use TYPO3\CMS\Core\Utility\GeneralUtility;

final class AddBackendPageTsConfigEventListener
{
    public function __invoke(BeforeLoadedPageTsConfigEvent $event): void
    {
        $extConf = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('content_animations');

        if ((bool)($extConf['hideFooterAnimationLabel'] ?? false)) {
            return;
        }

        $typo3Version = new Typo3Version();
        if ($typo3Version->getMajorVersion() === 13) {
            $event->addTsConfig(
                'templates.typo3/cms-backend.partialsRootPaths = baschte/content-animations:Resources/Private/TemplateOverrides/13/typo3/cms-backend'
            );

            return;
        }

        $event->addTsConfig(
            'templates.typo3/cms-backend.100 = baschte/content-animations:Resources/Private/TemplateOverrides/typo3/cms-backend'
        );
    }
}
