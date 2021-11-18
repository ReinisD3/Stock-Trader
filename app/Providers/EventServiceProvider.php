<?php

namespace App\Providers;

use App\Events\StockTradeEvent;
use App\Events\UserDeposited;
use App\Listeners\StockTradeCongratulationEmail;
use App\Listeners\UserDepositedConfirmationEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        ]
    ];


    public function boot()
    {
        //
    }
}
