<?php

namespace Illuminate\Tests\Notifications;

use SendGrid;
use Mockery as m;
use SendGrid\Mail\Mail;
use PHPUnit\Framework\TestCase;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SendGridMessage;
use Illuminate\Notifications\Channels\SendGridMailChannel;

class NotificationSendGridChannelTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testEmailIsSentViaSendGrid()
    {
        $notification = new NotificationSendGridChannelTestNotification;
        $notifiable = new NotificationSendGridChannelTestNotifiable;

        $channel = new SendGridMailChannel(
            $sendgrid = m::mock(SendGrid::class)
        );

        $message = $notification->toSendGrid($notifiable);

        $this->assertEquals($message->templateId, 'sendgrid-template-id');
        $this->assertEquals($message->from->getEmail(), 'test@example.com');
        $this->assertEquals($message->from->getName(), 'Example User');
        $this->assertEquals($message->tos[0]->getEmail(), 'test+test1@example.com');
        $this->assertEquals($message->tos[0]->getName(), 'Example User1');

        $sendgrid->shouldReceive('send');

        $channel->send($notifiable, $notification);
    }
}

class NotificationSendGridChannelTestNotifiable
{
    use Notifiable;
}

class NotificationSendGridChannelTestNotification extends Notification
{
    public function toSendGrid($notifiable)
    {
        return (new SendGridMessage('sendgrid-template-id'))
            ->from('test@example.com', 'Example User')
            ->to('test+test1@example.com', 'Example User1');
    }
}
