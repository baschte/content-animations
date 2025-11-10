<?php

declare(strict_types=1);

/*
 * This file is part of the package baschte/content-animations.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Baschte\ContentAnimations\DataProcessing;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * DataProcessor to generate animation settings
 */
class AnimationSettingsProcessor implements DataProcessorInterface
{
    private const ANIMATION_PREFIX = 'data-aos';
    private const DATA_COLUMN_PREFIX = 'tx_content_animations_';

    /**
     * @var array<string>
     */
    protected array $availableAosSettings = [
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
     * @var array<string>
     */
    protected array $fallbackAosSettings = [
        'easing',
        'once',
        'mirror',
    ];

    /**
     * @var array<int, string>
     */
    protected array $aosBooleanSettings = [
        'disable',
        'useClassNames',
        'disableMutationObserver',
        'aos-once',
        'aos-mirror',
    ];

    /**
     * @var array<string, mixed>
     */
    protected array $animationSettings = [];

    /**
     * Process data for content animations
     *
     * @return array<string, mixed>
     */
    public function process(// @phpstan-ignore-line
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ): array {
        /** @var array<string, mixed> $dataObj */
        $dataObj = $processedData['data'] ?? [];
        $optionsToRemove = $this->getOptionsToRemoveFromSettings($cObj, $processorConfiguration);
        $this->animationSettings = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('content_animations');

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
     * @param array<string|int, mixed> $array
     * @throws \RuntimeException
     */
    private static function getValueByPath(array $array, string $path, string $delimiter = '/'): mixed
    {
        // Extract parts of the path
        if ($path === '') {
            throw new \RuntimeException('Path must not be empty', 1341397767);
        }

        $path = str_getcsv($path, $delimiter, '"', '\\');

        // Loop through each part and extract its value
        $value = $array;
        foreach ($path as $segment) {
            $segment = (string) str_replace('-', '_', (string) $segment);
            if (is_array($value) && array_key_exists($segment, $value)) {
                // Replace current value with child
                $value = $value[$segment];
            } else {
                return null;
            }
        }
        return $value;
    }

    /**
     * @param array<string, mixed> $processorConfiguration
     * @return array<int, string>
     */
    private function getOptionsToRemoveFromSettings(ContentObjectRenderer $cObj, array $processorConfiguration): array
    {
        $removeOptionsValue = $cObj->stdWrapValue('removeOptions', $processorConfiguration);
        $optionsToRemove = is_string($removeOptionsValue) ? preg_replace('/\s+/', '', $removeOptionsValue) : '';
        if (!is_string($optionsToRemove)) {
            return [];
        }
        return explode(',', $optionsToRemove);
    }

    /**
     * @param array<string, mixed> $dataObj
     * @param array<string, mixed> $processedData
     * @return array<string, string>
     */
    private function prefixAndSetValuesToAnimationOptions(array $dataObj, array $processedData): array
    {
        $animationOptions = [];
        foreach ($this->availableAosSettings as $availableOption) {
            // replace '-animation' to guarantee animation is set correct for aos
            $optionKey = str_replace('_', '-', $availableOption);
            $optionKey = str_replace('-animation', '', self::ANIMATION_PREFIX . '-' . $optionKey);
            $value = self::getValueByPath($dataObj, self::DATA_COLUMN_PREFIX . $availableOption);

            // check if animation value is set => otherwise return nothing
            if ($availableOption === 'animation' && ($value === null || $value === '')) {
                return [];
            }

            // if no value is given => don't set it to array
            if ($value !== null && $value !== '') {
                $animationOptions[$optionKey] = (string) $value;
            }
        }

        // add default global settings to animationsArray if they're not set already
        // check if fallbackOptions already set => otherwise set them to default
        foreach ($this->fallbackAosSettings as $fallbackOption) {
            $fallbackKey = 'data-aos-' . $fallbackOption;
            $processedDataKey = 'aos-' . $fallbackOption;
            if (!array_key_exists($fallbackKey, $animationOptions) &&
             array_key_exists($processedDataKey, $processedData) &&
             $processedData[$processedDataKey] !== ''
            ) {
                $animationOptions[$fallbackKey] = (string) $processedData[$processedDataKey];
            }

            // override settings with global defaults if extendedAnimationSettings are not activated
            if (array_key_exists('extendedAnimationSettings', $this->animationSettings) && $this->animationSettings['extendedAnimationSettings'] !== '1') {
                $animationOptions[$fallbackKey] = (string) $processedData[$processedDataKey];
            }
        }

        // check if values should be converted to bool values
        foreach ($animationOptions as $key => $value) {
            if (in_array(str_replace('data-', '', $key), $this->aosBooleanSettings, true)) {
                $animationOptions[$key] = $value === '1' ? 'true' : 'false';
            }
        }

        return $animationOptions;
    }

    /**
     * @param array<string, string> $animationSettingsArray
     */
    private function generateAnimationAttributeSettingsFromAnimationsArray(array $animationSettingsArray): string
    {
        $animationSettings = '';
        // generate animation settings out of settingsArray
        foreach ($animationSettingsArray as $key => $value) {
            $animationSettings .= ' ' . $key . '="' . $value . '"';
        }
        return $animationSettings;
    }

    /**
     * @param array<int|string, string> $optionsToRemove
     */
    private function removeOptionsFromAvailableSettings(array $optionsToRemove): void
    {
        foreach ($optionsToRemove as $option) {
            if ($option !== '') {
                $this->availableAosSettings = ArrayUtility::removeArrayEntryByValue($this->availableAosSettings, $option);
                $this->fallbackAosSettings = ArrayUtility::removeArrayEntryByValue($this->fallbackAosSettings, $option);
            }
        }
    }

    /**
     * @param array<string, mixed> $processorConfiguration
     * @param array<string, mixed> $processedData
     */
    private function setSettingsToProcessedData(
        ContentObjectRenderer $cObj,
        array $processorConfiguration,
        array &$processedData,
        string $completeAnimationSettings
    ): void {
        $variableName = $cObj->stdWrapValue('as', $processorConfiguration);
        if (is_string($variableName) && $variableName !== '') {
            $processedData[$variableName] = $completeAnimationSettings;
        } else {
            $processedData['animationSettings'] = $completeAnimationSettings;
        }
    }
}
