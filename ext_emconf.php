<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "vnc_powermail_encrypt"
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title' => 'Powermail emails encryption',
    'description' => 'Adds encryption to receiver emails generated with powermail (based on Swift_Signers_SMimeSigner). Supports certifacates in .pem format',
    'category' => 'plugin',
    'author' => 'Vancado AG',
    'author_email' => '',
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '^9.5 || ^10.4'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
