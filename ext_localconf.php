<?php

if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

// register own renderType
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1552428667] = [
    'nodeName' => 'animationPreview',
    'priority' => '40',
    'class' => \Baschte\ContentAnimations\Form\Elements\AnimationPreviewField::class
];
