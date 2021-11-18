<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserDeposited
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private int $depositAmount;
    private string $userEmail;


    public function __construct(int $depositAmount, string $userEmail)
    {
        $this->depositAmount = $depositAmount;
        $this->userEmail = $userEmail;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public function getUserEmail(): string
    {
        return $this->userEmail;
    }

    public function getDepositAmount(): int
    {
        return $this->depositAmount;
    }
}
