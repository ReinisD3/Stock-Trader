<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserDepositedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private int $depositAmount;

    public function __construct(int $depositAmount)
    {
        $this->depositAmount = $depositAmount;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('New deposit made')
            ->markdown('mail.userDeposited',['depositAmount'=>$this->depositAmount]);
    }
}
