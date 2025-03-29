<?php

defined('TYPO3_MODE') || defined('TYPO3') || die('Access denied.');

if (class_exists(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class)) {
    /** @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher $signalSlotDispatcher */
    $signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class
    );
    $signalSlotDispatcher->connect(
        'In2code\Powermail\Domain\Service\Mail\SendMailService',
        'sendTemplateEmailBeforeSend',
        'Vancado\VncPowermailEncrypt\Domain\Service\Mail\SendMailService',
        'manipulateMail',
        FALSE
    );
}