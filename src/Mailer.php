<?php

namespace MDP\Mailer;

use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer as SymfonyMailer;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class Mailer
{
    private Transport\TransportInterface $transport;

    /**
     * Mailer constructor.
     * @throws WrongEnvSetupException
     */
    public function __construct()
    {
        $this->checkEnvVariables();
        $this->transport = $this->getTransport();
    }

    /**
     * @param string $subject
     * @param string $mailFrom
     * @param array $recipients
     * @param string $body
     * @return void
     * @throws TransportExceptionInterface
     */
    public function send(
        string $subject,
        string $mailFrom,
        array $recipients,
        string $body,
    ): void {

        $mailer = new SymfonyMailer($this->transport);

        $message = (new Email)
            ->subject($subject)
            ->from($mailFrom)
            ->to(...$recipients)
            ->html($body);


        $mailer->send($message);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendHtmltemplate(
        string $subject,
        string $mailFrom,
        array $recipients,
        string $templatePath,
        array $data
    ): void {
        $mailer = new SymfonyMailer($this->transport);

        $message = (new TemplatedEmail)
            ->subject($subject)
            ->from($mailFrom)
            ->to(...$recipients)
            ->htmlTemplate(__DIR__ . "/../../../" . $templatePath)
            ->context($data);

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

    private function getTransport(): Transport\TransportInterface
    {
        $host = $_ENV["MAIL_HOST"];
        $port = $_ENV["MAIL_PORT"];
        $user = $_ENV['MAIL_USERNAME'];
        $pass = $_ENV['MAIL_PASSWORD'];
        return Transport::fromDsn("smtp://{$user}:{$pass}@{$host}:{$port}");
    }
}
