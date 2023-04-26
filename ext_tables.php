<?php

if (!defined('TYPO3_MODE') && !defined('TYPO3')) {
    die ('Access denied.');
}

// get extensionConfiguration for 'content_animations'
$extensionManagementUtility = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class);
$extensionConfiguration = $extensionManagementUtility->get('content_animations');

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
	--palette--;LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:palette.extended-settings;
		tx_content_animations_extended
	'
    );
}
