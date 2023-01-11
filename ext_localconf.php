<?php
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die('Access denied.');

// register own renderType
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1552428667] = [
    'nodeName' => 'animationPreview',
    'priority' => '40',
    'class' => \Baschte\ContentAnimations\Form\Elements\AnimationPreviewField::class
];

// get extensionConfiguration for 'content_animations'
if (version_compare((new TYPO3\CMS\Core\Information\Typo3Version())->getMajorVersion(), '11.0.0', '>=')) {
    $extensionManagementUtility = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class);
    $extensionConfiguration = $extensionManagementUtility->get('content_animations');
} else {
    $extensionConfiguration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['content_animations']);
}

// register PageLayoutViewAnimationFooterPreview to tt_content_drawFooter hook if this feature is active
if (empty($extensionConfiguration['hideFooterAnimationLabel']) || !$extensionConfiguration['hideFooterAnimationLabel']) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawFooter'][] = \Baschte\ContentAnimations\Hooks\PageLayoutView\PageLayoutViewAnimationFooterPreview::class;
    ExtensionManagementUtility::addPageTSConfig('templates.typo3/cms-backend.partialsRootPaths = baschte/content-animations:Resources/Private/TemplateOverrides/typo3/cms-backend');
}
