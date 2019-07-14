<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// add static typoscript includes
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('content_animations', 'Configuration/TypoScript/BootstrapPackage/v11', 'Content Animations: Bootstrap Package v11.x');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('content_animations', 'Configuration/TypoScript/BootstrapPackage/v10', 'Content Animations: Bootstrap Package v10.x');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('content_animations', 'Configuration/TypoScript/BootstrapPackage/v9', 'Content Animations: Bootstrap Package v9.x');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('content_animations', 'Configuration/TypoScript/BootstrapPackage/v8', 'Content Animations: Bootstrap Package v8.x');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('content_animations', 'Configuration/TypoScript/FluidStyledContent', 'Content Animations: Fluid Styled Content');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('content_animations', 'Configuration/TypoScript/HigherEducationPackage/v9', 'Content Animations: Higher Education Package v9');
