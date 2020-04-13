<?php
namespace Baschte\ContentAnimations\ContentObject;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;
use TYPO3\CMS\Frontend\ContentObject\AbstractContentObject;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * Contains FILECONTENT class object.
 */
class FileContentContentObject extends AbstractContentObject
{
    /**
     * Rendering the cObject, FILECONTENT
     *
     * @param array $conf Array of TypoScript properties
     * @return string Output
     */
    public function render($conf = [])
    {
        $fileContent = '';
        $file = isset($conf['file.']) ? $this->cObj->stdWrap($conf['file'], $conf['file.']) : $conf['file'];
        try {
            // check if TYPO3 version 9 or higher
            if(explode(".", VersionNumberUtility::getCurrentTypo3Version())[0] > 8) {
                $file = GeneralUtility::makeInstance(\TYPO3\CMS\Frontend\Resource\FilePathSanitizer::class)->sanitize($file);
            } else {
                // fallback for TYPO3 version 8 and below
                $file = $this->getTypoScriptFrontendController()->tmpl->getFileName($file);
            }
            if (file_exists($file)) {
                $fileContent = file_get_contents($file);
            }
        } catch (\TYPO3\CMS\Core\Resource\Exception $e) {
            // do nothing
        }
        return $fileContent;
    }

    /**
     * @return TypoScriptFrontendController
     */
    protected function getTypoScriptFrontendController()
    {
        return $GLOBALS['TSFE'];
    }
}
