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
use TYPO3\CMS\Core\Page\AssetCollector;
use TYPO3\CMS\Core\Utility\PathUtility;

/**
 * Event listener to add AOS (Animate On Scroll) JavaScript inline to the page footer.
 *
 * This replaces the deprecated FILECONTENT TypoScript object with a modern
 * AssetCollector approach for TYPO3 13+.
 */
final readonly class AddAosJavaScriptEventListener
{
    public function __construct(
        private AssetCollector $assetCollector
    ) {
    }

    /**
     * Invoked when the event listener is triggered.
     *
     * Reads the AOS JavaScript file and adds it inline to the page footer,
     * followed by the AOS.init() call.
     */
    public function __invoke(): void
    {
        // Path to AOS JavaScript file
        $jsFile = 'EXT:content_animations/Resources/Public/JavaScript/Vendor/simple-aos/aos.4.2.0.min.js';

        try {
            // Resolve EXT: path to absolute file path
            $absolutePath = Environment::getPublicPath() . '/' . PathUtility::getPublicResourceWebPath($jsFile);

            if (file_exists($absolutePath)) {
                $jsContent = file_get_contents($absolutePath);

                if ($jsContent !== false) {
                    // Add AOS library inline
                    $this->assetCollector->addInlineJavaScript(
                        'content_animations_aos_lib',
                        $jsContent,
                        [],
                        ['priority' => true]
                    );

                    // Add AOS initialization
                    $this->assetCollector->addInlineJavaScript(
                        'content_animations_aos_init',
                        'AOS.init();',
                        [],
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
