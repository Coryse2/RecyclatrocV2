<?php

namespace App\Notification;

use Twig\Environment;
use App\Entity\Contact;


class ContactNotification
{


    /**
     * @var SwiftMailerHandler
     */
    private $mailer;


    /**
     * @var Environment
     */
    private $renderer;


    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function  notify(Contact $contact)
    {
        $message = (new \Swift_Message)
        ->setFrom($contact->getEmail())
        ->setTo('recyclatroc@gmail.com')
        ->setReplyTo($contact->getEmail())
        ->setBody($this->renderer->render('emails/contact.html.twig',[
            'contact'=>$contact
        ]), 'text/html');
        $this->mailer->send($message);
    }
}
