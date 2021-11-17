<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TradeDone extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct()
    {
        //
    }

    public function build()
    {
        return $this->subject('New Trade ')
            ->from(env('MAIL_FROM_ADDRESS'))
            ->view('mail.trade_done');

    }
}
