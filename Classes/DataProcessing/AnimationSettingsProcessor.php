<?php

namespace Baschte\ContentAnimations\DataProcessing;

/*
 *
 * This file is part of the "content_animations" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 Sebastian Richter <info@baschte.de>
 *
 */

use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * DataProcessor to generate animation settings
 *
 * 10 = Baschte\ContentAnimations\DataProcessing\AnimationSettingsProcessor
 *
 *
 * Advanced TypoScript configuration
 *
 * 10 = Baschte\ContentAnimations\DataProcessing\AnimationSettingsProcessor
 * 10 {
 *   removeOptions = anchor-placement, once, mirror
 *   as = animationSettings
 * }
 */
class AnimationSettingsProcessor implements DataProcessorInterface
{
    const ANIMATION_PREFIX = 'data-aos';
    const DATA_COLUMN_PREFIX = 'tx_content_animations_';

    /**
     * @var array
     */
    protected $availableAosSettings = [
        'animation',
        'duration',
        'easing',
        'once',
        'mirror',
        'offset',
        'delay',
        'anchor-placement',
    ];

    /**
     * @var array
     */
    protected $fallbackAosSettings = [
        'easing',
        'once',
        'mirror',
    ];

    /**
     * @var array
     */
    protected $aosBooleanSettings = [
        'disable',
        'useClassNames',
        'disableMutationObserver',
        'aos-once',
        'aos-mirror',
    ];

    /**
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData)
    {
        // generate default values => get given processor options
        $dataObj = $processedData['data'] ?? [];
        $optionsToRemove = $this->getOptionsToRemoveFromSettings($cObj, $processorConfiguration);

        // remove options from available animations array
        $this->removeOptionsFromAvailableSettings($optionsToRemove);

        // prefix and set values for animation options from $dataObj
        $animationSettingsArray = $this->prefixAndSetValuesToAnimationOptions($dataObj, $processedData);

        // generate complete settings as string
        $completeAnimationSettings = $this->generateAnimationAttributeSettingsFromAnimationsArray($animationSettingsArray);

        // update $processedData with given processor settings
        $this->setSettingsToProcessedData($cObj, $processorConfiguration, $processedData, $completeAnimationSettings);

        return $processedData;
    }

    /**
     * @param array $array
     * @param string $path
     * @param string $delimiter
     * @return array|string
     */
    private static function getValueByPath(array $array, string $path, string $delimiter = '/')
    {
        // Extract parts of the path
        if (is_string($path)) {
            if ($path === '') {
                // Programming error has to be sanitized before calling the method -> global exception
                throw new \RuntimeException('Path must not be empty', 1341397767);
            }
            $path = str_getcsv($path, $delimiter);
        }

        // Loop through each part and extract its value
        $value = $array;
        foreach ($path as $segment) {
            $segment = str_replace('-', '_', $segment);
            if (array_key_exists($segment, $value)) {
                // Replace current value with child
                $value = $value[$segment];
            } else {
                // add default empty value
                $value = null;
            }
        }
        return $value;
    }

    /**
     * @param ContentObjectRenderer $cObj
     * @param array $processorConfiguration
     * @return array
     */
    private function getOptionsToRemoveFromSettings(ContentObjectRenderer $cObj, array $processorConfiguration)
    {
        $optionsToRemove = preg_replace('/\s+/', '', $cObj->stdWrapValue('removeOptions', $processorConfiguration)) ?? '';
        return explode(',', $optionsToRemove);
    }

    /**
     * @param array $dataObj
     * @param array $processedData
     * @return array
     */
    private function prefixAndSetValuesToAnimationOptions(array $dataObj, array $processedData)
    {
        $animationOptions = [];
        foreach ($this->availableAosSettings as $availableOption) {
            // replace '-animation' to guarantee animation is set correct for aos
            $optionKey = str_replace('_', '-', $availableOption);
            $optionKey = str_replace('-animation', '', self::ANIMATION_PREFIX . '-' . $optionKey);
            $value = self::getValueByPath($dataObj, self::DATA_COLUMN_PREFIX . $availableOption);

            // check if animation value is set => otherwise return nothing
            if ($availableOption === 'animation' && empty($value)) {
                return [];
            };

            // if no value is given => don't set it to array
            if (isset($value) && !empty($value)) {
                $animationOptions[$optionKey] = $value;
            }
        }

        // add default global settings to animationsArray if they're not set already
        // check if fallbackOptions already set => otherwise set them to default
        foreach ($this->fallbackAosSettings as $fallbackOption) {
            if (!array_key_exists('data-aos-' . $fallbackOption, $animationOptions) && isset($processedData['aos-' . $fallbackOption])) {
                $animationOptions['data-aos-' . $fallbackOption] = $processedData['aos-' . $fallbackOption];
            }
        }

        // check if values should be converted to bool values
        foreach ($animationOptions as $key => $value) {
            if (in_array(str_replace('data-', '', $key), $this->aosBooleanSettings)) {
                $animationOptions[$key] = $value === 1 ? 'true' : 'false';
            }
        }

        return $animationOptions;
    }

    /**
     * @param array $animationSettingsArray
     * @return string
     */
    private function generateAnimationAttributeSettingsFromAnimationsArray(array $animationSettingsArray)
    {
        $animationSettings = '';
        // generate animation settings out of settingsArray
        foreach ($animationSettingsArray as $key => $value) {
            $animationSettings .= ' ' . $key . '="' . $value . '"';
        }
        return $animationSettings;
    }

    /**
     * @param array $optionsToRemove
     */
    private function removeOptionsFromAvailableSettings(array $optionsToRemove)
    {
        foreach ($optionsToRemove as $option) {
            if (!empty($option)) {
                $this->availableAosSettings = ArrayUtility::removeArrayEntryByValue($this->availableAosSettings, $option);
                $this->fallbackAosSettings = ArrayUtility::removeArrayEntryByValue($this->fallbackAosSettings, $option);
            }
        }
    }

    /**
     * @param ContentObjectRenderer $cObj
     * @param array $processorConfiguration
     * @param array $processedData
     * @param string $completeAnimationSettings
     */
    private function setSettingsToProcessedData(ContentObjectRenderer $cObj, array $processorConfiguration, array &$processedData, string $completeAnimationSettings)
    {
        $variableName = $cObj->stdWrapValue('as', $processorConfiguration);
        if (!empty($variableName)) {
            $processedData[$variableName] = $completeAnimationSettings;
        } else {
            $processedData['animationSettings'] = $completeAnimationSettings;
        }
    }
}
