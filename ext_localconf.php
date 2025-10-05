<?php

defined('TYPO3') || die();

call_user_func(static function () {
    // register own renderType
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1552428667] = [
        'nodeName' => 'animationPreview',
        'priority' => '40',
        'class' => \Baschte\ContentAnimations\Form\Elements\AnimationPreviewField::class
    ];

    // register own typoscript FILECONTENT cObject (can be removed once v11 suppot is dropped)
    if (!isset($GLOBALS['TYPO3_CONF_VARS']['FE']['ContentObjects']['FILECONTENT'])) {
        $GLOBALS['TYPO3_CONF_VARS']['FE']['ContentObjects'] = array_merge(
            $GLOBALS['TYPO3_CONF_VARS']['FE']['ContentObjects'] ?? [],
            ['FILECONTENT' => \Baschte\ContentAnimations\ContentObject\FileContentContentObject::class]
        );
    }

    // get extensionConfiguration for 'content_animations'
    $extensionManagementUtility = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class);
    $extensionConfiguration = $extensionManagementUtility->get('content_animations');

    // register footer preview to tt_content_drawFooter hook if this feature is active
    if (empty($extensionConfiguration['hideFooterAnimationLabel']) || !$extensionConfiguration['hideFooterAnimationLabel']) {
        TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('templates.typo3/cms-backend.partialsRootPaths = baschte/content-animations:Resources/Private/TemplateOverrides/typo3/cms-backend');
    }
});
