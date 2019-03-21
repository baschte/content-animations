<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// add static typoscript includes
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('content_animations', 'Configuration/TypoScript/BootstrapPackage', 'Content Animations: Bootstrap Package v10.x');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('content_animations', 'Configuration/TypoScript/FluidStyledContent', 'Content Animations: Fluid Styled Content');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('content_animations', 'Configuration/TypoScript/HigherEducationPackage', 'Content Animations: Higher Education Package v9.x');
