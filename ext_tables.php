<?php

if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
    \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
);

$packageConfiguration = $extensionConfiguration->get('content_animations');

if (empty($packageConfiguration['disableAddAnimationsTab'])) {
    // add animation tab to all ctypes
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content', '
    --div--;LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:tab.animation,
    --palette--;LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:palette.animation-settings;
        tx_content_animations_animation,
    --palette--;LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:palette.timing-settings;
        tx_content_animations_timing'
    );
}