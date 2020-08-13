<?php

namespace App\MessageHandler;



use App\Message\DailyReportNotification;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Address;

class DailyReportNotificationHandler implements MessageHandlerInterface
{
    private $mailer;
    private $mailAddress;
    /**
     * SmsNotificationHandler constructor.
     */
    public function __construct(MailerInterface $mailer,ContainerBagInterface $params)
    {
        $this->mailer = $mailer;
        $this->mailAddress = $params->get('report.mail');
    }

    public function __invoke(DailyReportNotification $notification)
    {
        $email = (new TemplatedEmail())
            ->from('someemail@test.com')
            ->to(new Address($this->mailAddress))
            ->subject('Daily generator report.')
            ->htmlTemplate('Emails/ReportMail.html.twig')
            ->context([
                'reportData' => $notification->getContent(),
            ]);
        $this->mailer->send($email);
    }
}