<?php


namespace App\Service;


use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail($data)
    {
        $email = (new Email())
            ->from($data['mail'])
            ->to('you@example.com')
            ->replyTo($data['mail'])
            ->subject($data['name'] . " à laissé un message!")
            ->text($data['message'])
            ->html('<h3>' . $data['name'] . ' à laissé un message sur le portfolio!</h3><p>' . $data['message'] . '</p>');

        $this->mailer->send($email);
    }
}