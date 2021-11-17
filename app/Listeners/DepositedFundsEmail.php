<?php

namespace App\Listeners;

use App\Events\FundsWereDeposited;
use App\Mail\FundsEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class DepositedFundsEmail implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(FundsWereDeposited $event)
    {
        Mail::to($event->getUserEmail())->send(new FundsEmail($event->getDepositAmount()));
    }
}
