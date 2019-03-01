<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

// add animation tab to all ctypes
ExtensionManagementUtility::addToAllTCAtypes('tt_content', '--div--;Animation,tx_content_animations_animation');
