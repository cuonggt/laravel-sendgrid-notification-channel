<?php

namespace Illuminate\Notifications\Channels;

use SendGrid;
use SendGrid\Mail\Mail;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SendGridMessage;

class SendGridMailChannel
{
    /**
     * The SendGrid client instance.
     *
     * @var \SendGrid
     */
    protected $sendgrid;

    /**
     * Create a new SendGrid channel instance.
     *
     * @return void
     */
    public function __construct(SendGrid $sendgrid)
    {
        $this->sendgrid = $sendgrid;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSendGrid($notifiable);

        if (! $message instanceof SendGridMessage) {
            return;
        }

        return $this->sendgrid->send(
            $this->buildMail($message)
        );
    }

    /**
     * Build up an Mail for the SendGrid.
     *
     * @param  \Illuminate\Notifications\Messages\SendGridMessage  $message
     * @return \SendGrid\Mail\Mail
     */
    public function buildMail(SendGridMessage $message)
    {
        $email = new Mail(
            $message->from,
            $message->tos
        );

        $email->setTemplateId($message->templateId);

        return $email;
    }
}
