<?php

/*
 * This file is part of the package baschte/content-animations.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') || die();

// add all fields to tt_content
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    [
        'tx_content_animations_animation' => [
            'exclude' => true,
            'label' => 'LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:label.animation',
            'config' => [
                'items' => [
                    [
                        'label' => 'LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:item.no-animation',
                        'value' => '',
                    ],
                    [
                        'label' => 'LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:item.fade-animations',
                        'value' => '--div--',
                    ],
                    [
                        'label' => 'fade',
                        'value' => 'fade',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/fade.gif',
                    ],
                    [
                        'label' => 'fade-up',
                        'value' => 'fade-up',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/fade-up.gif',
                    ],
                    [
                        'label' => 'fade-down',
                        'value' => 'fade-down',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/fade-down.gif',
                    ],
                    [
                        'label' => 'fade-right',
                        'value' => 'fade-right',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/fade-right.gif',
                    ],
                    [
                        'label' => 'fade-left',
                        'value' => 'fade-left',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/fade-left.gif',
                    ],
                    [
                        'label' => 'fade-up-right',
                        'value' => 'fade-up-right',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/fade-up-right.gif',
                    ],
                    [
                        'label' => 'fade-up-left',
                        'value' => 'fade-up-left',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/fade-up-left.gif',
                    ],
                    [
                        'label' => 'fade-down-right',
                        'value' => 'fade-down-right',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/fade-down-right.gif',
                    ],
                    [
                        'label' => 'fade-down-left',
                        'value' => 'fade-down-left',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/fade-down-left.gif',
                    ],
                    [
                        'label' => 'LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:item.flip-animations',
                        'value' => '--div--',
                    ],
                    [
                        'label' => 'flip-up',
                        'value' => 'flip-up',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/flip-up.gif',
                    ],
                    [
                        'label' => 'flip-down',
                        'value' => 'flip-down',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/flip-down.gif',
                    ],
                    [
                        'label' => 'flip-left',
                        'value' => 'flip-left',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/flip-left.gif',
                    ],
                    [
                        'label' => 'flip-right',
                        'value' => 'flip-right',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/flip-right.gif',
                    ],
                    [
                        'label' => 'LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:item.slide-animations',
                        'value' => '--div--',
                    ],
                    [
                        'label' => 'slide-up',
                        'value' => 'slide-up',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/slide-up.gif',
                    ],
                    [
                        'label' => 'slide-down',
                        'value' => 'slide-down',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/slide-down.gif',
                    ],
                    [
                        'label' => 'slide-right',
                        'value' => 'slide-right',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/slide-right.gif',
                    ],
                    [
                        'label' => 'slide-left',
                        'value' => 'slide-left',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/slide-left.gif',
                    ],
                    [
                        'label' => 'LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:item.zoom-animations',
                        'value' => '--div--',
                    ],
                    [
                        'label' => 'zoom-in',
                        'value' => 'zoom-in',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/zoom-in.gif',
                    ],
                    [
                        'label' => 'zoom-in-up',
                        'value' => 'zoom-in-up',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/zoom-in-up.gif',
                    ],
                    [
                        'label' => 'zoom-in-down',
                        'value' => 'zoom-in-down',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/zoom-in-down.gif',
                    ],
                    [
                        'label' => 'zoom-in-right',
                        'value' => 'zoom-in-right',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/zoom-in-right.gif',
                    ],
                    [
                        'label' => 'zoom-in-left',
                        'value' => 'zoom-in-left',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/zoom-in-left.gif',
                    ],
                    [
                        'label' => 'zoom-out',
                        'value' => 'zoom-out',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/zoom-out.gif',
                    ],
                    [
                        'label' => 'zoom-out-up',
                        'value' => 'zoom-out-up',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/zoom-out-up.gif',
                    ],
                    [
                        'label' => 'zoom-out-down',
                        'value' => 'zoom-out-down',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/zoom-out-down.gif',
                    ],
                    [
                        'label' => 'zoom-out-right',
                        'value' => 'zoom-out-right',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/zoom-out-right.gif',
                    ],
                    [
                        'label' => 'zoom-out-left',
                        'value' => 'zoom-out-left',
                        'icon' => 'EXT:content_animations/Resources/Public/Images/zoom-out-left.gif',
                    ],
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
                'type' => 'number',
                'size' => 5,
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
                'type' => 'number',
                'size' => 5,
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
                'type' => 'number',
                'size' => 5,
                'default' => 0,
            ],
        ],
        'tx_content_animations_anchor_placement' => [
            'exclude' => true,
            'label' => 'LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:label.anchor-placement',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => '',
                        'value' => '',
                    ],
                    [
                        'label' => 'top-bottom',
                        'value' => 'top-bottom',
                    ],
                    [
                        'label' => 'top-center',
                        'value' => 'top-center',
                    ],
                    [
                        'label' => 'top-top',
                        'value' => 'top-top',
                    ],
                    [
                        'label' => 'center-bottom',
                        'value' => 'center-bottom',
                    ],
                    [
                        'label' => 'center-center',
                        'value' => 'center-center',
                    ],
                    [
                        'label' => 'center-top',
                        'value' => 'center-top',
                    ],
                    [
                        'label' => 'bottom-bottom',
                        'value' => 'bottom-bottom',
                    ],
                    [
                        'label' => 'bottom-center',
                        'value' => 'bottom-center',
                    ],
                    [
                        'label' => 'bottom-top',
                        'value' => 'bottom-top',
                    ],
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
                    [
                        'label' => '',
                        'value' => '',
                    ],
                    [
                        'label' => 'linear',
                        'value' => 'linear',
                    ],
                    [
                        'label' => 'ease',
                        'value' => 'ease',
                    ],
                    [
                        'label' => 'ease-in',
                        'value' => 'ease-in',
                    ],
                    [
                        'label' => 'ease-out',
                        'value' => 'ease-out',
                    ],
                    [
                        'label' => 'ease-in-out',
                        'value' => 'ease-in-out',
                    ],
                    [
                        'label' => 'ease-in-back',
                        'value' => 'ease-in-back',
                    ],
                    [
                        'label' => 'ease-out-back',
                        'value' => 'ease-out-back',
                    ],
                    [
                        'label' => 'ease-in-out-back',
                        'value' => 'ease-in-out-back',
                    ],
                    [
                        'label' => 'ease-in-sine',
                        'value' => 'ease-in-sine',
                    ],
                    [
                        'label' => 'ease-out-sine',
                        'value' => 'ease-out-sine',
                    ],
                    [
                        'label' => 'ease-in-out-sine',
                        'value' => 'ease-in-out-sine',
                    ],
                    [
                        'label' => 'ease-in-quad',
                        'value' => 'ease-in-quad',
                    ],
                    [
                        'label' => 'ease-out-quad',
                        'value' => 'ease-out-quad',
                    ],
                    [
                        'label' => 'ease-in-out-quad',
                        'value' => 'ease-in-out-quad',
                    ],
                    [
                        'label' => 'ease-in-cubic',
                        'value' => 'ease-in-cubic',
                    ],
                    [
                        'label' => 'ease-out-cubic',
                        'value' => 'ease-out-cubic',
                    ],
                    [
                        'label' => 'ease-in-out-cubic',
                        'value' => 'ease-in-out-cubic',
                    ],
                    [
                        'label' => 'ease-in-quart',
                        'value' => 'ease-in-quart',
                    ],
                    [
                        'label' => 'ease-out-quart',
                        'value' => 'ease-out-quart',
                    ],
                    [
                        'label' => 'ease-in-out-quart',
                        'value' => 'ease-in-out-quart',
                    ],
                ],
            ],
        ],
    ]
);

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
