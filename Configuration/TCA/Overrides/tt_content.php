<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$tempColumns = [
    'tx_content_animations_animation' => [
        'config' => [
            'items' => [
                ['none', ''],
                ['Fade animations:', '--div--'],
                ['fade-up', 'fade-up', 'EXT:content_animations/Resources/Public/Images/fade-up.gif'],
                ['fade-down', 'fade-down', 'EXT:content_animations/Resources/Public/Images/fade-down.gif'],
                ['fade-left', 'fade-left', 'EXT:content_animations/Resources/Public/Images/fade-right.gif'],
                ['fade-right', 'fade-right', 'EXT:content_animations/Resources/Public/Images/fade-left.gif'],
                ['fade-up-right', 'fade-up-right', 'EXT:content_animations/Resources/Public/Images/fade-up-right.gif'],
                ['fade-up-left', 'fade-up-left', 'EXT:content_animations/Resources/Public/Images/fade-up-left.gif'],
                ['fade-down-right', 'fade-down-right', 'EXT:content_animations/Resources/Public/Images/fade-down-right.gif'],
                ['fade-down-left', 'fade-down-left', 'EXT:content_animations/Resources/Public/Images/fade-down-left.gif'],
                ['Flip animations:', '--div--'],
                ['flip-up', 'flip-up', 'EXT:content_animations/Resources/Public/Images/flip-up.gif'],
                ['flip-down', 'flip-down', 'EXT:content_animations/Resources/Public/Images/flip-down.gif'],
                ['flip-right', 'flip-right', 'EXT:content_animations/Resources/Public/Images/flip-right.gif'],
                ['flip-left', 'flip-left', 'EXT:content_animations/Resources/Public/Images/flip-left.gif'],
                ['Slide animations:', '--div--'],
                ['slide-up', 'slide-up', 'EXT:content_animations/Resources/Public/Images/slide-up.gif'],
                ['slide-down', 'slide-down', 'EXT:content_animations/Resources/Public/Images/slide-down.gif'],
                ['slide-right', 'slide-right', 'EXT:content_animations/Resources/Public/Images/slide-right.gif'],
                ['slide-left', 'slide-left', 'EXT:content_animations/Resources/Public/Images/slide-left.gif'],
                ['Zoom animations:', '--div--'],
                ['zoom-in', 'zoom-in', 'EXT:content_animations/Resources/Public/Images/zoom-in.gif'],
                ['zoom-in-up', 'zoom-in-up', 'EXT:content_animations/Resources/Public/Images/zoom-in-up.gif'],
                ['zoom-in-down', 'zoom-in-down', 'EXT:content_animations/Resources/Public/Images/zoom-in-down.gif'],
                ['zoom-in-left', 'zoom-in-left', 'EXT:content_animations/Resources/Public/Images/zoom-in-left.gif'],
                ['zoom-in-right', 'zoom-in-right', 'EXT:content_animations/Resources/Public/Images/zoom-in-right.gif'],
                ['zoom-out', 'zoom-out', 'EXT:content_animations/Resources/Public/Images/zoom-out.gif'],
                ['zoom-out-up', 'zoom-out-up', 'EXT:content_animations/Resources/Public/Images/zoom-out-up.gif'],
                ['zoom-out-down', 'zoom-out-down', 'EXT:content_animations/Resources/Public/Images/zoom-out-down.gif'],
                ['zoom-out-right', 'zoom-out-right', 'EXT:content_animations/Resources/Public/Images/zoom-out-right.gif'],
                ['zoom-out-left', 'zoom-out-left', 'EXT:content_animations/Resources/Public/Images/zoom-out-left.gif'],
            ],
            'renderType' => 'selectSingle',
            'type' => 'select',
            'size' => 1,
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
