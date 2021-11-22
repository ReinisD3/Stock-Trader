<?php

namespace App\Services\UsersControllerServices\DepositService;

use App\Events\UserDeposited;
use App\Http\Requests\DepositFundsRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DepositService
{
    public function handle(DepositFundsRequest $request):void
    {
        $user = User::find(Auth::id());
        $total = $user->balance + (int) $request['depositAmount'];
        $user->update(['balance' => $total]);

        event(new UserDeposited($request['depositAmount'], $user->email));

    }


}
