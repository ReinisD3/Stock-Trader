<?php

namespace App\Listeners;

use App\Events\StockTradeEvent;
use App\Mail\TradeDone;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class StockTradeCongratulationEmail implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct()
    {

    }

    public function handle(StockTradeEvent $event)
    {
        Mail::to('trader@gmail.com')->send(new TradeDone());
    }
}
