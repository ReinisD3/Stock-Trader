<?php

namespace App\Events;


use App\Models\Trade\Trade;
use App\Models\TradeTransaction;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StockTradeEvent
{
    use Dispatchable, SerializesModels;


    private TradeTransaction $trade;
    private User $user;

    public function __construct(TradeTransaction $trade, User $user)
    {

        $this->trade = $trade;
        $this->user = $user;
    }

    public function getTrade(): TradeTransaction
    {
        return $this->trade;
    }

    public function getUser(): User
    {
        return $this->user;
    }

}
