<?php

namespace Baschte\ContentAnimations\Hooks\PageLayoutView;

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

use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawFooterHookInterface;

/**
 * Class PageLayoutDrawAnimationInfo
 *
 * @package Baschte\ContentAnimations\Hooks\PageLayoutDraw
 */
class PageLayoutViewAnimationFooterPreview implements PageLayoutViewDrawFooterHookInterface
{
    /**
     * @param PageLayoutView $parentObject
     * @param array $info
     * @param array $row
     * @return string
     */
    public function preProcess(PageLayoutView &$parentObject, &$info, array &$row)
    {
        // get processedValue for the animation and set it to the footer of the CE
        $parentObject->getProcessedValue('tt_content', 'tx_content_animations_animation', $row, $info);
    }
}