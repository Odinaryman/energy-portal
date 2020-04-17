<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $name;
    public $user;
    public $password;
    public $url;

    public function __construct($name, $user, $password,$url)
    {
        $this->name = $name;
        $this->user = $user;
        $this->password = $password;
        $this->url=$url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->subject('NRGBEE Account Login Details!')
                    ->markdown('mails.register');
    }
}
