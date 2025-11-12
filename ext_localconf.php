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

    // get extensionConfiguration for 'content_animations'
    $extConf = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
    )->get('content_animations');

    // register footer preview to tt_content_drawFooter hook if this feature is active
    if (empty($extConf['hideFooterAnimationLabel']) || !$extConf['hideFooterAnimationLabel']) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'templates.typo3/cms-backend.partialsRootPaths = baschte/content-animations:Resources/Private/TemplateOverrides/typo3/cms-backend'
        );
    }
});
