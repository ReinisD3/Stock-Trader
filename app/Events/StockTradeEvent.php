<?php

namespace App\Events;

use App\Models\Trade;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StockTradeEvent
{
    use Dispatchable, SerializesModels;


    private Trade $trade;
    private User $user;

    public function __construct(Trade $trade, User $user)
    {

        $this->trade = $trade;
        $this->user = $user;
    }

    public function getTrade(): Trade
    {
        return $this->trade;
    }

    public function getUser(): User
    {
        return $this->user;
    }

}
