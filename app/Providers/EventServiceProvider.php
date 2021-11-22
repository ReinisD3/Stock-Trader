<?php

namespace App\Providers;

use App\Events\SellTradeEvent;
use App\Events\StockTradeEvent;
use App\Events\UserDeposited;
use App\Listeners\SellTradeEmail;
use App\Listeners\StockTradeCongratulationEmail;
use App\Listeners\UserDepositedConfirmationEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        StockTradeEvent::class => [
            StockTradeCongratulationEmail::class
        ],
        UserDeposited::class => [
            UserDepositedConfirmationEmail::class
        ],
        SellTradeEvent::class => [
            SellTradeEmail::class
        ]
    ];


    public function boot()
    {
        //
    }
}
