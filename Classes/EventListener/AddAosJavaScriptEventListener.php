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
 * Event listener to add AOS (Animate On Scroll) JavaScript inline to the page footer.
 *
 * This replaces the deprecated FILECONTENT TypoScript object with a modern
 * AssetCollector approach for TYPO3 13+.
 *
 * CSP Support: Adds nonce attribute to inline scripts for Content Security Policy compatibility
 * when CSP is enabled (nonce available). Falls back to no nonce when CSP is disabled.
 */
final readonly class AddAosJavaScriptEventListener
{
    public function __construct(
        private AssetCollector $assetCollector,
        private RequestId $requestId
    ) {
    }

    /**
     * Invoked when the event listener is triggered.
     *
     * Reads the AOS JavaScript file and adds it inline to the page footer.
     * If CSP is enabled (nonce available), adds nonce attribute to inline scripts.
     */
    public function __invoke(): void
    {
        // Path to AOS JavaScript file
        $jsFile = 'EXT:content_animations/Resources/Public/JavaScript/Vendor/simple-aos/aos.4.2.1.min.js';

        try {
            // Check if CSP is enabled by checking if nonce is available
            $attributes = [];
            try {
                $nonce = $this->requestId->nonce->consume();
                if (!empty($nonce)) {
                    // CSP is enabled - add nonce attribute
                    $attributes = ['nonce' => $nonce];
                }
            } catch (\Throwable $e) {
                // CSP is disabled - no nonce available, continue without attributes
            }

            // Resolve EXT: path to absolute file path
            $absolutePath = Environment::getPublicPath() . '/' . PathUtility::getPublicResourceWebPath($jsFile);

            if (file_exists($absolutePath)) {
                $jsContent = file_get_contents($absolutePath);

                if ($jsContent !== false) {
                    // Add AOS library inline (with or without nonce)
                    $this->assetCollector->addInlineJavaScript(
                        'content_animations_aos_lib',
                        $jsContent,
                        $attributes,
                        ['priority' => true]
                    );

                    // Add AOS initialization (with or without nonce)
                    $this->assetCollector->addInlineJavaScript(
                        'content_animations_aos_init',
                        'AOS.init();',
                        $attributes,
                        ['priority' => false]
                    );
                }
            }
        } catch (\Exception $e) {
            // Silently fail if file cannot be read
            // In production, you might want to log this
        }
    }
}
