<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

// register signal slot for adding necessary TCA fields to really all elements of this TYPO3 instance
$signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);
$signalSlotDispatcher->connect(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::class, 'tcaIsBeingBuilt', \Baschte\ContentAnimations\Slots\ExtTablesInclusionPostProcessing::class, 'processData');
