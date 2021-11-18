<?php

namespace App\Services\UsersControllerServices\DepositService;

use App\Events\UserDeposited;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositService
{
    public function handle(Request $request):void
    {
        $deposit = $request->validate([
            'amount' => ['required', 'numeric']
        ]);
        $user = User::find(Auth::id());
        $total = $user->balance + (int) $deposit['amount'];
        $user->update(['balance' => $total]);

        event(new UserDeposited($deposit['amount'], $user->email));

    }


}
