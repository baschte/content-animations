<?php

namespace Baschte\ContentAnimations\Slots;

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

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * Class ExtTablesInclusionPostProcessing
 *
 * @package Baschte\ContentAnimations\Slots
 */
class ExtTablesInclusionPostProcessing
{
    /**
     * @param $tca
     * @return array
     */
    function processData($tca)
    {
        // Move the local $tca to global variable to use general modification functions like addToAllTCAtypes
        $GLOBALS['TCA'] = $tca;

        // add new animation field to all TCA types
        ExtensionManagementUtility::addToAllTCAtypes('tt_content', '--div--;Animation,content_animation');

        // return the modified global TCA definition
        return [$GLOBALS['TCA']];
    }
}
