<?php

/************************************************************************
 * Extension Manager/Repository config file for ext: "content_animations"
 ***********************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title' => 'Content animations',
    'description' => 'allows the editor to set a frontend animation for your content elements',
    'category' => 'fe',
    'author' => 'Sebastian Richter',
    'author_email' => 'info@baschte.de',
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-9.5.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
