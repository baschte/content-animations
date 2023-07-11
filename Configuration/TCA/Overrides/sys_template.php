<?php
if (!defined('TYPO3_MODE') && !defined('TYPO3')) {
    die('Access denied.');
}

// add static typoscript includes
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('content_animations', 'Configuration/TypoScript', 'Content Animations: Basic Configuration');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('content_animations', 'Configuration/TypoScript/BootstrapPackage/v14', 'Content Animations: Bootstrap Package v14.x');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('content_animations', 'Configuration/TypoScript/BootstrapPackage/v13', 'Content Animations: Bootstrap Package v13.x');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('content_animations', 'Configuration/TypoScript/BootstrapPackage/v12', 'Content Animations: Bootstrap Package v12.x');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('content_animations', 'Configuration/TypoScript/BootstrapPackage/v11', 'Content Animations: Bootstrap Package v11.x');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('content_animations', 'Configuration/TypoScript/FluidStyledContent', 'Content Animations: Fluid Styled Content');
