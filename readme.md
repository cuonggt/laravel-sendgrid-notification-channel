## SendGrid Mail Notifications

### Prerequisites

`SendGrid` supports sending emails using it's pre-defined templates to format mail messsages. Before you can send SendGrid Mail notifications, you need to install the notification channel via Composer:

    cuonggt/laravel-sendgrid-notification-channel

Next, you will need to add a few configuration options to your `config/services.php` configuration file. You may copy the example configuration below to get started:

```
'sendgrid' => [
    'api_key' => env('SENDGRID_API_KEY'),
],
```

### Formatting SendGrid Mail Notifications

You should define a `toSendGrid` method on the notification class. This method will receive a `$notifiable` entity and should return a  `Illuminate\Notifications\Messages\SendGridMessage` instance:

/**
 * Get the SendGrid representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return SendGridMessage
 */
public function toSendGrid($notifiable)
{
    return (new SendGridMessage('Your SendGrid template ID'))
                ->from('test@example.com', 'Example User')
                ->to('test+test1@example.com', 'Example User1');
}
