<?php

namespace MDP\Mailer;


use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer as SymfonyMailer;

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
     * @throws TransportExceptionInterface
     */
    public function send(
        string $subject,
        string $mailFrom,
        array $recipients,
        string $body,
    ): void
    {
        $host = $_ENV["MAIL_HOST"];
        $port = $_ENV["MAIL_PORT"];
        $user = $_ENV['MAIL_USERNAME'];
        $pass = $_ENV['MAIL_PASSWORD'];
        $transport = Transport::fromDsn("smtp://{$user}:{$pass}@{$host}:{$port}");

        $mailer = new SymfonyMailer($transport);

        $message = (new Email)
            ->subject($subject)
            ->from($mailFrom)
            ->to(...$recipients)
            ->html($body);


        $mailer->send($message);
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
