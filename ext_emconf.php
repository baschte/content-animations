<?php

/************************************************************************
 * Extension Manager/Repository config file for ext: "content_animations"
 ***********************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title' => 'Content Animations',
    'description' => 'This extension allows you to set nice animations to your content elements if they are scrolled into the browsers viewport. To install it include the static typoscript of content_animations to your template and you\'re good to go. Have fun! :-)',
    'category' => 'fe',
    'author' => 'Sebastian Richter',
    'author_email' => 'info@baschte.de',
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '2.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-10.9.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
