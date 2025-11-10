<?php

/*
 * This file is part of the package baschte/content-animations.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

return [
    'dependencies' => [
        'core',
    ],
    'tags' => [
        'backend.form',
    ],
    'imports' => [
        '@baschte/content-animations/preview.js' => 'EXT:content_animations/Resources/Public/JavaScript/preview.js',
    ],
];
