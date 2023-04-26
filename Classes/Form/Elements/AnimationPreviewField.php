<?php

namespace Baschte\ContentAnimations\Form\Elements;

/*
 *
 * This file is part of the "content_animations" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Sebastian Richter <info@baschte.de>
 *
 */

use TYPO3\CMS\Backend\Form\NodeFactory;
use TYPO3\CMS\Backend\Form\NodeInterface;
use TYPO3\CMS\Backend\Form\Utility\FormEngineUtility;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Page\JavaScriptModuleInstruction;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\StringUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Class AnimationPreviewField
 *
 * @package Baschte\ContentAnimations\Form\Elements
 */
class AnimationPreviewField implements NodeInterface
{
    /** @var array $data */
    protected $data;

    /** @var NodeFactory $nodeFactory */
    protected $nodeFactory;

    /**
     * Default field information enabled for this element.
     *
     * @var array
     */
    protected $defaultFieldInformation = [];

    /**
     * All nodes get an instance of the NodeFactory and the main data array
     *
     * @param NodeFactory $nodeFactory
     * @param array $data
     */
    public function __construct(NodeFactory $nodeFactory, array $data)
    {
        $this->data = $data;
        $this->nodeFactory = $nodeFactory;
    }

    /**
     * Main render method
     *
     * @return array
     * @throws \TYPO3\CMS\Backend\Form\Exception
     */
    public function render()
    {
        $parameterArray = $this->data['parameterArray'];
        $config = $parameterArray['fieldConf']['config'];
        $fieldInformationResult = $this->renderFieldInformation();
        $fieldInformationHtml = $fieldInformationResult['html'];

        // Initialization:
        $selectId = StringUtility::getUniqueId('tceforms-select-');
        $selectItems = $parameterArray['fieldConf']['config']['items'];
        $selectedIcon = '';
        $size = (int)$config['size'];

        // Style set on <select/>
        $options = '';
        $disabled = false;
        if (!empty($config['readOnly'])) {
            $disabled = true;
        }

        // Prepare groups
        $selectItemCounter = 0;
        $selectItemGroupCount = 0;
        $selectItemGroups = [];
        $selectedValue = '';
        $hasIcons = false;

        if (!empty($parameterArray['itemFormElValue'])) {
            $selectedValue = (string)$parameterArray['itemFormElValue'][0];
        }

        foreach ($selectItems as $item) {
            if (($item['value'] ?? $item[1]) === '--div--') {
                // IS OPTGROUP
                if ($selectItemCounter !== 0) {
                    $selectItemGroupCount++;
                }
                $selectItemGroups[$selectItemGroupCount]['header'] = [
                    'title' => $item['label'] ?? $item[0],
                ];
            } else {
                // IS ITEM
                $icon = !empty($item['icon'] ?? $item[2] ?? null) ? FormEngineUtility::getIconHtml($item['icon'] ?? $item[2], $item['label'] ?? $item[0], $item['label'] ?? $item[0]) : '';
                $selected = $selectedValue === (string)($item['value'] ?? $item[1]);

                if ($selected) {
                    $selectedIcon = $icon;
                }

                $selectItemGroups[$selectItemGroupCount]['items'][] = [
                    'title' => $this->appendValueToLabelInDebugMode($item['label'] ?? $item[0], $item['value'] ?? $item[1]),
                    'value' => $item['value'] ?? $item[1],
                    'icon' => $icon,
                    'selected' => $selected,
                ];
                $selectItemCounter++;
            }
        }

        // Fallback icon
        if (!$selectedIcon && isset($selectItemGroups[0]['items'][0]['icon'])) {
            $selectedIcon = $selectItemGroups[0]['items'][0]['icon'];
        }

        // Process groups
        foreach ($selectItemGroups as $selectItemGroup) {
            // suppress groups without items
            if (empty($selectItemGroup['items'])) {
                continue;
            }

            $optionGroup = is_array($selectItemGroup['header'] ?? null);
            $options .= ($optionGroup ? '<optgroup label="' . htmlspecialchars($selectItemGroup['header']['title'], ENT_COMPAT, 'UTF-8', false) . '">' : '');

            if (is_array($selectItemGroup['items'])) {
                foreach ($selectItemGroup['items'] as $item) {
                    $options .= '<option value="' . htmlspecialchars($item['value']) . '" data-icon="' .
                        htmlspecialchars($item['icon']) . '"'
                        . ($item['selected'] ? ' selected="selected"' : '') . '>' . htmlspecialchars($item['title'], ENT_COMPAT, 'UTF-8', false) . '</option>';
                }
                $hasIcons = !empty($item['icon']);
            }

            $options .= ($optionGroup ? '</optgroup>' : '');
        }

        $selectAttributes = [
            'id' => $selectId,
            'name' => $parameterArray['itemFormElName'],
            'data-formengine-validation-rules' => $this->getValidationDataAsJsonString($config),
            'class' => 'form-control form-control-adapt',
        ];
        if ($size) {
            $selectAttributes['size'] = $size;
        }
        if ($disabled) {
            $selectAttributes['disabled'] = 'disabled';
        }

        $html = [];
        $html[] = '<div class="formengine-field-item t3js-formengine-field-item">';
        $html[] = $fieldInformationHtml;
        $html[] = '<div class="form-control-wrap">';
        $html[] = '<div class="form-wizards-wrap">';
        $html[] = '<div class="form-wizards-element">';
        if ($hasIcons) {
            $html[] = '<div class="input-group">';
            $html[] = '<span class="input-group-addon input-group-icon">';
            $html[] = $selectedIcon;
            $html[] = '</span>';
        }
        $html[] = '<select ' . GeneralUtility::implodeAttributes($selectAttributes, true) . '>';
        $html[] = $options;
        $html[] = '</select>';
        if ($hasIcons) {
            $html[] = '</div>';
        }
        $html[] = '</div>';
        if (!$disabled && !empty($fieldWizardHtml)) {
            $html[] = '<div class="form-wizards-items-bottom">';
            $html[] = $fieldWizardHtml;
            $html[] = '</div>';
        }
        $html[] = '</div>';
        $html[] = '</div>';
        $html[] = '</div>';

        $html[] = '<div id="preview-content-animation">';
        $html[] = '<div class="preview-label" data-show-preview="false">' . LocalizationUtility::translate('LLL:EXT:content_animations/Resources/Private/Language/locallang_be.xlf:preview-label') . '</div>';

        if (is_array($parameterArray['itemFormElValue']) && !empty($parameterArray['itemFormElValue'])) {
            $html[] = '<div class="ce-preview" data-aos="' . $parameterArray['itemFormElValue']['0'] . '">';
        } else {
            $html[] = '<div class="ce-preview" data-aos>';
        }

        $html[] = '<span class="ce-preview__item"></span>';
        $html[] = '<span class="ce-preview__item"></span>';
        $html[] = '<span class="ce-preview__item"></span>';
        $html[] = '<span class="ce-preview__item ce-preview__item--xs"></span>';
        $html[] = '</div>';
        $html[] = '</div>';

        $result = [
            'html' => implode(LF, $html),
            'additionalInlineLanguageLabelFiles' => [],
            'stylesheetFiles' => [
                'EXT:content_animations/Resources/Public/Styles/animation-preview.min.css',
                'EXT:content_animations/Resources/Public/JavaScript/Vendor/simple-aos/aos.css'
            ],
        ];

        if ((new Typo3Version())->getMajorVersion() === 12) {
            $result['javaScriptModules'][] = JavaScriptModuleInstruction::create(
                '@baschte/content-animations/preview.js',
            );
        } else {
            $result['requireJsModules'] = [
                'TYPO3/CMS/ContentAnimations/AnimationPreview'
            ];
        }
        return $result;
    }

    /**
     * Build JSON string for validations rules.
     *
     * @param array $config
     * @return string
     */
    protected function getValidationDataAsJsonString(array $config): string
    {
        $validationRules = [];
        if (!empty($config['eval'])) {
            $evalList = GeneralUtility::trimExplode(',', $config['eval'], true);
            foreach ($evalList as $evalType) {
                $validationRules[] = [
                    'type' => $evalType,
                ];
            }
        }
        if (!empty($config['range'])) {
            $newValidationRule = [
                'type' => 'range',
            ];
            if (!empty($config['range']['lower'])) {
                $newValidationRule['lower'] = $config['range']['lower'];
            }
            if (!empty($config['range']['upper'])) {
                $newValidationRule['upper'] = $config['range']['upper'];
            }
            $validationRules[] = $newValidationRule;
        }
        if (!empty($config['maxitems']) || !empty($config['minitems'])) {
            $minItems = isset($config['minitems']) ? (int)$config['minitems'] : 0;
            $maxItems = isset($config['maxitems']) ? (int)$config['maxitems'] : 99999;
            $type = $config['type'] ?: 'range';
            $validationRules[] = [
                'type' => $type,
                'minItems' => $minItems,
                'maxItems' => $maxItems
            ];
        }
        if (!empty($config['required'])) {
            $validationRules[] = ['type' => 'required'];
        }
        return json_encode($validationRules);
    }

    /**
     * Append the value of a form field to its label
     *
     * @param string|int $label The label which can also be an integer
     * @param string|int $value The value which can also be an integer
     * @return string|int
     */
    protected function appendValueToLabelInDebugMode($label, $value)
    {
        if ($value !== '' && $GLOBALS['TYPO3_CONF_VARS']['BE']['debug'] && $this->getBackendUser()->isAdmin()) {
            return $label . ' [' . $value . ']';
        }

        return $label;
    }

    /**
     * Merge field information configuration with default and render them.
     *
     * @return array
     * @throws \TYPO3\CMS\Backend\Form\Exception
     */
    protected function renderFieldInformation(): array
    {
        $options = $this->data;
        $fieldInformation = $this->defaultFieldInformation;
        $fieldInformationFromTca = $options['parameterArray']['fieldConf']['config']['fieldInformation'] ?? [];
        ArrayUtility::mergeRecursiveWithOverrule($fieldInformation, $fieldInformationFromTca);
        $options['renderType'] = 'fieldInformation';
        $options['renderData']['fieldInformation'] = $fieldInformation;
        return $this->nodeFactory->create($options)->render();
    }

    /**
     * Returns the current BE user.
     *
     * @return BackendUserAuthentication
     */
    protected function getBackendUser()
    {
        return $GLOBALS['BE_USER'];
    }
}
