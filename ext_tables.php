<?php

/*
 * This file is part of the package baschte/content-animations.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') || die();

call_user_func(static function () {
    // get extensionConfiguration for 'content_animations'
    $extConf = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
    )->get('content_animations');

    // add animation tab to all CTypes if not disabled via extension settings
    if (!$extConf['disableAddAnimationsTab'] && !$extConf['extendedAnimationSettings']) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
            'tt_content',
            '
        --div--;LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:tab.animation,
        --palette--;LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:palette.animation-settings;
            tx_content_animations_animation,
        --palette--;LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:palette.timing-settings;
            tx_content_animations_timing
        '
        );
    }

    // extended animation settings for all CTypes
    if (!$extConf['disableAddAnimationsTab'] && $extConf['extendedAnimationSettings']) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
            'tt_content',
            '
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

    // add own footer partial to containerConfiguration if container extension is installed
    if (empty($extConf['hideFooterAnimationLabel']) || !$extConf['hideFooterAnimationLabel']) {
        $containerConfiguration = &$GLOBALS['TCA']['tt_content']['containerConfiguration'] ?? null;
        if ($containerConfiguration) {
            foreach (array_keys($containerConfiguration) as $cType) {
                $containerConfiguration[$cType]['gridPartialPaths'][] = 'EXT:content_animations/Resources/Private/TemplateOverrides/typo3/cms-backend/Partials';
            }
        }
    }
});
