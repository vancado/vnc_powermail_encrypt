<?php

defined('TYPO3_MODE') || defined('TYPO3') || die('Access denied.');

call_user_func(
    function() {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('vnc_powermail_encrypt', 'Configuration/TypoScript', 'Powermail emails encryption');
    }
);
