<?php

namespace Illuminate\Notifications;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Channels\SendGridMailChannel;

class SendGridChannelServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        Notification::extend('sendgrid', function ($app) {
            return new Channels\SendGridMailChannel();
        });
    }
}
