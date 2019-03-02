<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

// add animation tab to all ctypes
ExtensionManagementUtility::addToAllTCAtypes('tt_content', '
    --div--;LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:tab.animation,
    --palette--;LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:palette.animation-settings;
        tx_content_animations_animation,
    --palette--;LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:palette.timing-settings;
        tx_content_animations_timing'
);
