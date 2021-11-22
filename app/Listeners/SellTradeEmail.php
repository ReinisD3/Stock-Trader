<?php

namespace App\Listeners;

use App\Events\SellTradeEvent;
use App\Mail\SellTrade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SellTradeEmail implements ShouldQueue
{

    public function __construct()
    {
        //
    }

    public function handle(SellTradeEvent $event)
    {
        Mail::to($event->getUser()->email)->send(new SellTrade($event->getTrade()));
    }
}
