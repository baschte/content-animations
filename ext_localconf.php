<?php

/*
 * This file is part of the package baschte/content-animations.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') || die();

call_user_func(static function () {
    // register own renderType for animation preview field
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1552428667] = [
        'nodeName' => 'animationPreview',
        'priority' => '40',
        'class' => \Baschte\ContentAnimations\Form\Elements\AnimationPreviewField::class,
    ];
});
