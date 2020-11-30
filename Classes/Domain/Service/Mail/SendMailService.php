<?php
declare(strict_types=1);
namespace Vancado\VncPowermailEncrypt\Domain\Service\Mail;

use In2code\Powermail\Domain\Service\Mail\SendMailService as SendMailServicePowermail;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;

/**
 * SendMailService
 *
 */
class SendMailService
{

    /**
     * Manipulate message object short before powermail send the mail
     *
     * @param MailMessage $message
     * @param array $email
     * @param SendMailServicePowermail $originalService
     */
    public function manipulateMail($message, &$email, SendMailServicePowermail $originalService): void
    {

        $settings = $originalService->getSettings();
        $encryptionSettings = is_array($settings['encryption']) ? $settings['encryption'] : [];

        // encrypt receiver mails only
        if ( ($originalService->getType() == 'receiver') && ($encryptionSettings['enabled'])) {

            $certificates = is_array($encryptionSettings['certificates']) ? $encryptionSettings['certificates'] : [];

            foreach($certificates as $item) {
                
                if ($email['receiverEmail'] == $item['email']) {

                    $certificatePath = GeneralUtility::getFileAbsFileName($encryptionSettings['certificatePath']);
                    $certificate = $certificatePath . $item['certificate'];

                    if (@file_exists($certificate)) {
                        $this->encryptMessageBody($message, $certificate);
                    }
                }
            }
        }
    }

    protected function encryptMessageBody(&$message, $certificatePath): void
    {

        $typo3Version = VersionNumberUtility::convertVersionNumberToInteger(VersionNumberUtility::getNumericTypo3Version());

        // TYPO3 v.10 and up uses Symfony\Mail\Email
        if ($typo3Version > 10000000) {
            $smimeSigner = new \Symfony\Component\Mime\Crypto\SMimeEncrypter($certificatePath);
            $encryptedMessage = $smimeSigner->encrypt($message);
        
        // TYPO3 v.9 uses Swift Mailer
        } elseif ($typo3Version > 9000000) {
            $smimeSigner = new \Swift_Signers_SMimeSigner();
            $smimeSigner->setEncryptCertificate($certificatePath);
            $message->attachSigner($smimeSigner);
            $encryptedMessage = clone $message;
        }

        $encryptedMessageBody = $encryptedMessage->getBody();
        $message->setBody($encryptedMessageBody);
    }
}