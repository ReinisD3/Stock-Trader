<?php

namespace App\Events;

use App\Models\Company;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StockTradeEvent
{
    use Dispatchable, SerializesModels;


    public function __construct()
    {

    }


}
