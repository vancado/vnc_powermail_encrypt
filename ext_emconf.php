<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "vnc_powermail_encrypt"
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title' => 'Emails encryption for powermail',
    'description' => 'Adds encryption to powermail receiver emails with Secure Email (S/MIME) certificate. Supports certificates in .pem format.',
    'category' => 'misc',
    'author' => 'Vancado AG',
    'author_email' => '',
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.1.0',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.20-13.4.99',
            'powermail' => '7.0.0-13.9.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
