<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $fullName;
    public string $otp;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fullName, $otp)
    {
        //
        $this->fullName = $fullName;
        $this->otp = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.OtpEmail', ['fullName'=>$this->fullName,'otp'=>$this->otp]);
    }
}
