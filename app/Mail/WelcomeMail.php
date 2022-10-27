<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

//    protected string $email;
    protected string $fullName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $fullName)
    {
//        $this->email = $email;
        $this->fullName = $fullName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.WelcomeEmail', [ 'fullName'=>$this->fullName]);
    }
}
