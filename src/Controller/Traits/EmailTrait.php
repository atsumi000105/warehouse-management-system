<?php

namespace App\Controller\Traits;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Component\VarDumper\VarDumper;

trait EmailTrait
{
    public function sendEmail(TransportInterface $mailer, string $emailAddress): void
    {
        $email = (new Email())
            ->from('contact@activelogiclabs.com')
            ->to('jose.pages@activelogiclabs.com')
            ->subject('Successful registration3333')
            ->html('<p>Hello world!</p>');

        $mailer->send($email);
    }

    public function sendTemplatedEmail(TransportInterface $mailer, string $templatePath, array $contextParams = [], string $toEmailAddress): void
    {
        $email = (new TemplatedEmail())
            ->from('contact@activelogiclabs.com')
            ->to($toEmailAddress)
            ->subject('Successful registration')
            ->htmlTemplate($templatePath);

        if (! empty($contextParams)) {
            $email->context($contextParams);
        }

        $mailer->send($email);
    }
}
