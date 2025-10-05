<?php

defined('TYPO3') || die();

call_user_func(static function () {
    // get typo3 version
    $typo3Version = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Information\Typo3Version::class);

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

    // add own footer partial to containerConfiguration if TYPO3 > v11 and ext: container is installed and used
    if ($typo3Version->getMajorVersion() > 11) {
        if (empty($extensionConfiguration['hideFooterAnimationLabel']) || !$extensionConfiguration['hideFooterAnimationLabel']) {
            $containerConfiguration = &$GLOBALS['TCA']['tt_content']['containerConfiguration'] ?? null;
            if ($containerConfiguration) {
                foreach (array_keys($containerConfiguration) as $cType) {
                    $containerConfiguration[$cType]['gridPartialPaths'][] = 'EXT:content_animations/Resources/Private/TemplateOverrides/typo3/cms-backend/Partials';
                }
            }
        }
    }
});
