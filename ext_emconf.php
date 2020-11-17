<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "vnc_powermail_encrypt"
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title' => 'Powermail emails encryption',
    'description' => 'Adds encryption to receiver emails generated with powermail with Secure Email (S/MIME) certificate. Supports certificates in .pem format',
    'category' => 'plugin',
    'author' => 'Vancado AG',
    'author_email' => '',
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.3',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.20-10.4.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
