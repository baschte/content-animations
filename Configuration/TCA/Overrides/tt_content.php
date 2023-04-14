<?php
if (!defined('TYPO3_MODE') && !defined('TYPO3')) {
    die('Access denied.');
}

$tempColumns = [
    'tx_content_animations_animation' => [
        'exclude' => true,
        'label' => 'LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:label.animation',
        'config' => [
            'items' => [
                ['LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:item.no-animation', ''],
                ['LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:item.fade-animations', '--div--'],
                ['fade', 'fade', 'EXT:content_animations/Resources/Public/Images/fade.gif'],
                ['fade-up', 'fade-up', 'EXT:content_animations/Resources/Public/Images/fade-up.gif'],
                ['fade-down', 'fade-down', 'EXT:content_animations/Resources/Public/Images/fade-down.gif'],
                ['fade-right', 'fade-right', 'EXT:content_animations/Resources/Public/Images/fade-right.gif'],
                ['fade-left', 'fade-left', 'EXT:content_animations/Resources/Public/Images/fade-left.gif'],
                ['fade-up-right', 'fade-up-right', 'EXT:content_animations/Resources/Public/Images/fade-up-right.gif'],
                ['fade-up-left', 'fade-up-left', 'EXT:content_animations/Resources/Public/Images/fade-up-left.gif'],
                ['fade-down-right', 'fade-down-right', 'EXT:content_animations/Resources/Public/Images/fade-down-right.gif'],
                ['fade-down-left', 'fade-down-left', 'EXT:content_animations/Resources/Public/Images/fade-down-left.gif'],
                ['LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:item.flip-animations', '--div--'],
                ['flip-up', 'flip-up', 'EXT:content_animations/Resources/Public/Images/flip-up.gif'],
                ['flip-down', 'flip-down', 'EXT:content_animations/Resources/Public/Images/flip-down.gif'],
                ['flip-left', 'flip-left', 'EXT:content_animations/Resources/Public/Images/flip-left.gif'],
                ['flip-right', 'flip-right', 'EXT:content_animations/Resources/Public/Images/flip-right.gif'],
                ['LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:item.slide-animations', '--div--'],
                ['slide-up', 'slide-up', 'EXT:content_animations/Resources/Public/Images/slide-up.gif'],
                ['slide-down', 'slide-down', 'EXT:content_animations/Resources/Public/Images/slide-down.gif'],
                ['slide-right', 'slide-right', 'EXT:content_animations/Resources/Public/Images/slide-right.gif'],
                ['slide-left', 'slide-left', 'EXT:content_animations/Resources/Public/Images/slide-left.gif'],
                ['LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:item.zoom-animations', '--div--'],
                ['zoom-in', 'zoom-in', 'EXT:content_animations/Resources/Public/Images/zoom-in.gif'],
                ['zoom-in-up', 'zoom-in-up', 'EXT:content_animations/Resources/Public/Images/zoom-in-up.gif'],
                ['zoom-in-down', 'zoom-in-down', 'EXT:content_animations/Resources/Public/Images/zoom-in-down.gif'],
                ['zoom-in-right', 'zoom-in-right', 'EXT:content_animations/Resources/Public/Images/zoom-in-right.gif'],
                ['zoom-in-left', 'zoom-in-left', 'EXT:content_animations/Resources/Public/Images/zoom-in-left.gif'],
                ['zoom-out', 'zoom-out', 'EXT:content_animations/Resources/Public/Images/zoom-out.gif'],
                ['zoom-out-up', 'zoom-out-up', 'EXT:content_animations/Resources/Public/Images/zoom-out-up.gif'],
                ['zoom-out-down', 'zoom-out-down', 'EXT:content_animations/Resources/Public/Images/zoom-out-down.gif'],
                ['zoom-out-right', 'zoom-out-right', 'EXT:content_animations/Resources/Public/Images/zoom-out-right.gif'],
                ['zoom-out-left', 'zoom-out-left', 'EXT:content_animations/Resources/Public/Images/zoom-out-left.gif'],
            ],
            'renderType' => 'animationPreview',
            'type' => 'select',
            'size' => 1,
        ],
    ],
    'tx_content_animations_duration' => [
        'exclude' => true,
        'label' => 'LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:label.duration',
        'config' => [
            'type' => 'input',
            'size' => 5,
            'eval' => 'trim,int',
            'range' => [
                'lower' => 400,
                'upper' => 3000,
            ],
            'default' => 800,
            'slider' => [
                'step' => 50,
                'width' => 200,
            ],
        ],
    ],
    'tx_content_animations_delay' => [
        'exclude' => true,
        'label' => 'LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:label.delay',
        'config' => [
            'type' => 'input',
            'size' => 5,
            'eval' => 'trim,int',
            'range' => [
                'lower' => 0,
                'upper' => 3000,
            ],
            'default' => 0,
            'slider' => [
                'step' => 50,
                'width' => 200,
            ],
        ],
    ],

    'tx_content_animations_offset' => [
        'exclude' => true,
        'label' => 'LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:label.offset',
        'config' => [
            'type' => 'input',
            'size' => 5,
            'eval' => 'trim,int',
            'default' => 0,
        ],
    ],

    'tx_content_animations_anchor_placement' => [
        'exclude' => true,
        'label' => 'LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:label.anchor-placement',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            //'size' => 1,
            'items' => [
                ['', ''],
                ['top-bottom', 'top-bottom'],
                ['top-center', 'top-center'],
                ['top-top', 'top-top'],
                ['center-bottom', 'center-bottom'],
                ['center-center', 'center-center'],
                ['center-top', 'center-top'],
                ['bottom-bottom', 'bottom-bottom'],
                ['bottom-center', 'bottom-center'],
                ['bottom-top', 'bottom-top'],
            ],
        ],
    ],
    'tx_content_animations_once' => [
        'exclude' => true,
        'label' => 'LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:label.once',
        'description' => 'LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:desc.once',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'default' => 1,
        ],
    ],
    'tx_content_animations_mirror' => [
        'exclude' => true,
        'label' => 'LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:label.mirror',
        'description' => 'LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:desc.mirror',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'default' => 0,
        ],
    ],
    'tx_content_animations_easing' => [
        'exclude' => true,
        'label' => 'LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:label.easing',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['', ''],
                ['linear', 'linear'],
                ['ease', 'ease'],
                ['ease-in', 'ease-in'],
                ['ease-out', 'ease-out'],
                ['ease-in-out', 'ease-in-out'],
                ['ease-in-back', 'ease-in-back'],
                ['ease-out-back', 'ease-out-back'],
                ['ease-in-out-back', 'ease-in-out-back'],
                ['ease-in-sine', 'ease-in-sine'],
                ['ease-out-sine', 'ease-out-sine'],
                ['ease-in-out-sine', 'ease-in-out-sine'],
                ['ease-in-quad', 'ease-in-quad'],
                ['ease-out-quad', 'ease-out-quad'],
                ['ease-in-out-quad', 'ease-in-out-quad'],
                ['ease-in-cubic', 'ease-in-cubic'],
                ['ease-out-cubic', 'ease-out-cubic'],
                ['ease-in-out-cubic', 'ease-in-out-cubic'],
                ['ease-in-quart', 'ease-in-quart'],
                ['ease-out-quart', 'ease-out-quart'],
                ['ease-in-out-quart', 'ease-in-out-quart'],
            ],
        ],
    ],
];

// add new animation palettes
$GLOBALS['TCA']['tt_content']['palettes']['tx_content_animations_animation'] = [
    'showitem' => 'tx_content_animations_animation',
];

// add new animation speed palette
$GLOBALS['TCA']['tt_content']['palettes']['tx_content_animations_timing'] = [
    'showitem' => '
        tx_content_animations_duration,
        tx_content_animations_delay
    ',
];

// add new extended animations palette
$GLOBALS['TCA']['tt_content']['palettes']['tx_content_animations_extended'] = [
    'showitem' => '
        tx_content_animations_once,
        tx_content_animations_mirror,
        --linebreak--,
        tx_content_animations_easing,
        --linebreak--,
        tx_content_animations_anchor_placement,
        --linebreak--,
        tx_content_animations_offset
    ',
];

// add all fields to tt_content
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns);
