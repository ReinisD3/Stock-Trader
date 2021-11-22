<?php

namespace App\Services\UsersControllerServices\ProfileService;

use App\Models\Trade\Trade;
use App\Models\User;

class ProfileService
{
    public function __construct()
    {
    }
    public function handle():int
    {

       return Trade::where(['user_id' => auth()->user()->id])
           ->sum('usd_invested');
    }
}
