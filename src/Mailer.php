<?php

namespace MDP\Mailer;

use Swift_Mailer;
use Swift_Message;
use Swift_Mime_SimpleMessage;
use Swift_SmtpTransport;

class Mailer
{
    /**
     * Mailer constructor.
     * @throws WrongEnvSetupException
     */
    public function __construct()
    {
        $this->checkEnvVariables();
    }

    /**
     * @param string $subject
     * @param string $mailFrom
     * @param string $nameFrom
     * @param array $recipients
     * @param string $body
     * @param int $priority
     * @return int
     */
    public function send(
        string $subject,
        string $mailFrom,
        string $nameFrom,
        array $recipients,
        string $body,
        int $priority = Swift_Mime_SimpleMessage::PRIORITY_NORMAL
    ): int
    {
        $transport = new Swift_SmtpTransport(
            $_ENV['MAIL_HOST'],
            $_ENV['MAIL_PORT']
        );
        $transport->setUsername($_ENV['MAIL_USERNAME'])
            ->setPassword($_ENV['MAIL_PASSWORD'])
            ->setEncryption($_ENV['MAIL_ENCRYPTION']);

        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message($subject, $body))
            ->setFrom([$mailFrom => $nameFrom])
            ->setTo($recipients);

        $message->setPriority($priority);

        return $mailer->send($message);
    }

    /**
     * @throws WrongEnvSetupException
     */
    private function checkEnvVariables(): void
    {
        if (
            !count($_ENV) ||
            !isset($_ENV['MAIL_HOST']) ||
            !isset($_ENV['MAIL_PORT']) ||
            !isset($_ENV['MAIL_USERNAME']) ||
            !isset($_ENV['MAIL_PASSWORD']) ||
            !isset($_ENV['MAIL_ENCRYPTION'])
        ) {
            throw new WrongEnvSetupException();
        }
    }
}
