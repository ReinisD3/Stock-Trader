<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FundsEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    private int $deposit;

    public function __construct(int $deposit)
    {
        $this->deposit = $deposit;
    }


    public function build()
    {
        return $this->from("elina.pulke@gmail.com")
                    ->subject("deposit mail")
                    ->markdown("mail.fundsDeposited", ["deposit" => $this->deposit]);
    }
}
