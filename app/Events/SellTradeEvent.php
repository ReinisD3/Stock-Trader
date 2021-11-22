<?php

namespace App\Events;

use App\Models\TradeTransaction;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SellTradeEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private TradeTransaction $trade;
    private User $user;


    public function __construct(TradeTransaction $trade, User $user)
    {

        $this->trade = $trade;
        $this->user = $user;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
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
