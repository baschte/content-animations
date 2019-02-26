<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$tempColumns = [
    'tx_content_animations_animation' => [
        'config' => [
            'items' => [
                ['none', ''],
                ['fade-up', 'fade-up'],
                ['fade-down', 'fade-down'],
                ['fade-right', 'fade-right'],
                ['fade-left', 'fade-left'],
                ['fade-up-right', 'fade-up-right'],
                ['fade-up-left', 'fade-up-left'],
                ['fade-down-right', 'fade-down-right'],
                ['fade-down-left', 'fade-down-left'],
                ['flip-up', 'flip-up'],
                ['flip-down', 'flip-down'],
                ['flip-right', 'flip-right'],
                ['flip-left', 'flip-left'],
                ['slide-up', 'slide-up'],
                ['slide-down', 'slide-down'],
                ['slide-right', 'slide-right'],
                ['slide-left', 'slide-left'],
                ['zoom-in', 'zoom-in'],
                ['zoom-in-up', 'zoom-in-up'],
                ['zoom-in-down', 'zoom-in-down'],
                ['zoom-in-left', 'zoom-in-left'],
                ['zoom-in-right', 'zoom-in-right'],
                ['zoom-out', 'zoom-out'],
                ['zoom-out-up', 'zoom-out-up'],
                ['zoom-out-down', 'zoom-out-down'],
                ['zoom-out-right', 'zoom-out-right'],
                ['zoom-out-left', 'zoom-out-left'],
            ],
            'renderType' => 'selectSingle',
            'type' => 'select',
            'fieldWizard' => [
                'selectIcons' => [
                    'disabled' => false
                ]
            ],
        ],
        'exclude' => '1',
        'label' => 'Animation (translate)',
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns);

// add static typoscript include
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('content_animations', 'Configuration/TypoScript', 'Content animations');
