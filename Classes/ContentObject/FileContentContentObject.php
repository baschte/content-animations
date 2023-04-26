<?php
namespace Baschte\ContentAnimations\ContentObject;

/*
 *
 * This file is part of the "content_animations" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021 Sebastian Richter <info@baschte.de>
 *
 */

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;
use TYPO3\CMS\Frontend\ContentObject\AbstractContentObject;

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
        $typo3Version = intval(explode(".", VersionNumberUtility::getCurrentTypo3Version())[0]);
        $fileContent = '';
        $file = isset($conf['file.']) ? $this->cObj->stdWrap($conf['file'], $conf['file.']) : $conf['file'];
        try {
            // check if TYPO3 version 11 or higher
            if($typo3Version >= 11) {
                $filePath= Environment::getPublicPath() . PathUtility::getPublicResourceWebPath($file);
            // check if TYPO3 version 9 or higher
            } else {
                $filePath = GeneralUtility::makeInstance(\TYPO3\CMS\Frontend\Resource\FilePathSanitizer::class)->sanitize($file);
            }
            if (file_exists($filePath)) {
                $fileContent = file_get_contents($filePath);
            }
        } catch (\TYPO3\CMS\Core\Resource\Exception $e) {
            // do nothing
        }
        return $fileContent;
    }
}
