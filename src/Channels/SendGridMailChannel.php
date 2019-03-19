<?php

namespace Illuminate\Notifications\Channels;

use Illuminate\Notifications\Notification;

class SendGridMailChannel
{
    /**
     * Create a new SendGrid channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        //
    }
}
