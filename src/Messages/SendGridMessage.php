<?php

namespace Illuminate\Notifications\Messages;

use SendGrid\Mail\To;
use SendGrid\Mail\From;

class SendGridMessage
{
    /**
     * The "from" information for the message.
     *
     * @var \SendGrid\Mail\From
     */
    public $from;

    /**
     * The "tos" for the message.
     *
     * @var array
     */
    public $tos = [];

    /**
     * The SendGrid Template ID for the message.
     *
     * @var string
     */
    public $templateId;

    public function __construct()
    {
        $this->from = new From(
            $this->app->config['mail.from.address'],
            $this->app->config['mail.from.name']
        );
    }

    public function from($email, $name)
    {
        $this->from = new From($email, $name);

        return $this;
    }

    public function to($email, $name, $data = [])
    {
        $this->tos = array_merge($this->tos, new To($email, $name, $data));

        return $this;
    }

    public function templateId($templateId)
    {
        $this->templateId = $templateId;

        return $this;
    }
}
