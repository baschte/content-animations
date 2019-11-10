<?php

if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

//@todo: change this to new ExtensionConfiguration api on the next TYPO3 version
$extensionConfiguration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['content_animations']);

// add animation tab to all CTypes if not disabled via extension settings
if (!$extensionConfiguration['disableAddAnimationsTab'] && !$extensionConfiguration['extendedAnimationSettings']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content', '
    --div--;LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:tab.animation,
    --palette--;LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:palette.animation-settings;
        tx_content_animations_animation,
    --palette--;LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:palette.timing-settings;
        tx_content_animations_timing
	'
    );
}

// extended animation settings for all CTypes
if (!$extensionConfiguration['disableAddAnimationsTab'] && $extensionConfiguration['extendedAnimationSettings']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content', '
	--div--;LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:tab.animation,
	--palette--;LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:palette.animation-settings;
		tx_content_animations_animation,
	--palette--;LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:palette.timing-settings;
		tx_content_animations_timing,
	--palette--;Extended animation settings (trans);
		tx_content_animations_extended
	'
    );
}
