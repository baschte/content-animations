<?php

declare(strict_types=1);

/*
 * This file is part of the package baschte/content-animations.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Baschte\ContentAnimations\EventListener;

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Core\RequestId;
use TYPO3\CMS\Core\Page\AssetCollector;
use TYPO3\CMS\Core\Utility\PathUtility;

/**
 * Event listener to add AOS (Animate On Scroll) CSS to the page.
 *
 * This EventListener loads the aos.css file via AssetCollector to ensure
 * Content Security Policy (CSP) compatibility. By loading CSS as an external
 * stylesheet with a nonce attribute, CSP violations are avoided.
 *
 * The nonce attribute is only added when CSP is actually enabled (detected by
 * checking if a nonce is available from RequestId).
 *
 * @see https://github.com/baschte/content-animations/issues/21
 */
final readonly class AddAosStyleEventListener
{
    public function __construct(
        private AssetCollector $assetCollector,
        private RequestId $requestId
    ) {
    }

    /**
     * Invoked when the event listener is triggered.
     *
     * Adds the AOS CSS file to the page header via AssetCollector.
     * If CSP is enabled (nonce available), adds nonce attribute for CSP compatibility.
     */
    public function __invoke(): void
    {
        // Path to AOS CSS file
        $cssFile = 'EXT:content_animations/Resources/Public/JavaScript/Vendor/simple-aos/aos.css';

        // Check if CSP is enabled by checking if nonce is available
        $attributes = [];
        try {
            $nonce = $this->requestId->nonce->consume();
            if ($nonce !== '') {
                // CSP is enabled - add nonce attribute
                $attributes = ['nonce' => $nonce];
            }
        } catch (\Throwable $e) {
            // CSP is disabled - no nonce available, continue without attributes
        }

        // Resolve EXT: path to absolute file path
        $absolutePath = Environment::getPublicPath() . '/' . PathUtility::getPublicResourceWebPath($cssFile);

        if (file_exists($absolutePath)) {
            $cssContent = file_get_contents($absolutePath);

            if ($cssContent !== false) {
                // Add CSS stylesheet to page head (with or without nonce)
                $this->assetCollector->addInlineStyleSheet(
                    'content_animations_aos_css',
                    $cssContent,
                    $attributes,
                    ['priority' => true]
                );
            }
        }
    }
}
