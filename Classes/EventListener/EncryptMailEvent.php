<?php

declare(strict_types=1);

namespace Vancado\VncPowermailEncrypt\EventListener;

use In2code\Powermail\Events\SendMailServicePrepareAndSendEvent;
use TYPO3\CMS\Core\Log\LogManager;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

final class EncryptMailEvent
{
    /**
     * Method __invoke
     *
     * @param SendMailServicePrepareAndSendEvent $event Dispatched event
     *
     * @return void
     */
    public function __invoke(SendMailServicePrepareAndSendEvent $event)
    {
        $email = $event->getEmail();
        $message = $event->getMailMessage();
        $service = $event->getSendMailService();

        $settings = $service->getSettings();
        $encryptionSettings = is_array($settings['encryption']) ? $settings['encryption'] : [];

        // encrypt receiver mails only
        if ( ($service->getType() == 'receiver') && ($encryptionSettings['enabled'])) {

            $certificates = is_array($encryptionSettings['certificates']) ? $encryptionSettings['certificates'] : [];

            foreach($certificates as $item) {

                if ($email['receiverEmail'] == $item['email']) {

                    $certificatePath = GeneralUtility::getFileAbsFileName($encryptionSettings['certificatePath']);
                    $certificate = $certificatePath . DIRECTORY_SEPARATOR . $item['certificate'];

                    if (@file_exists($certificate)) {
                        $this->encryptMessageBody($message, $certificate);

                    } else {
                        $logger = GeneralUtility::makeInstance(LogManager::class)->getLogger(__CLASS__);
                        $logger->warning('Certificate for email ' . $email['receiverEmail'] . ' does not exist, message will not be encrypted.');
                    }
                }
            }
        }
    }
        
    /**
     * Method encryptMessageBody
     *
     * @param MailMessage $message Contains all mail message informations
     * @param string $certificatePath Path to certificate
     *
     * @return void
     */
    private function encryptMessageBody(MailMessage $message, string $certificatePath): void
    {
        $smimeSigner = new \Symfony\Component\Mime\Crypto\SMimeEncrypter($certificatePath);
        $encryptedMessage = $smimeSigner->encrypt($message);
        $encryptedMessageBody = $encryptedMessage->getBody();
        $message->setBody($encryptedMessageBody);
    }
}