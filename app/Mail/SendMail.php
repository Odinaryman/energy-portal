<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $units_left;

    public function __construct($name, $units_left)
    {
        $this->name = $name;
        $this->units_left = $units_left;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->subject('Energy Alarm Warning!')
                    ->markdown('mails.alarm')
                    ->text('mails.alarm_plain');
    }
}
