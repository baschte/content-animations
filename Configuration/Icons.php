<?php

declare(strict_types=1);

/*
 * This file is part of the package baschte/content-animations.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

/**
 * Icon registry for content_animations extension.
 *
 * This file registers all icons used in the TYPO3 backend.
 * Icons are automatically loaded by TYPO3's icon registry.
 */
return [
    // Extension icon (used in Extension Manager, etc.)
    'content-animations-extension' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:content_animations/Resources/Public/Icons/Extension.svg',
    ],
];
