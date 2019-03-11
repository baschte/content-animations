<?php

if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][time()] = [
    'nodeName' => 'animationPreview',
    'priority' => '70',
    'class' => \Baschte\ContentAnimations\Form\Elements\AnimationPreviewField::class
];
