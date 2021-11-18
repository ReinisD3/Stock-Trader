<?php

namespace App\Listeners;

use App\Events\UserDeposited;
use App\Mail\UserDepositedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class UserDepositedConfirmationEmail implements ShouldQueue
{

    public function __construct()
    {
        //
    }

    public function handle(UserDeposited $event)
    {
        Mail::to($event->getUserEmail())->send(new UserDepositedMail($event->getDepositAmount()));
    }
}
