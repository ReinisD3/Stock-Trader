<?php

namespace App\Http\Controllers;


use App\Events\StockTradeEvent;
use App\Models\Trade;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class TradeController extends Controller
{


    public function buy(string $companySymbol)
    {
        $user = User::find(Auth::id());
        $stockAmount = request()->validate([
           'amount' => ['required','numeric' ]
        ]);
        $stockAmount['amount'] = (int)$stockAmount['amount'];

        $balance = $user->balance - $stockAmount['amount'];
        $user->update(['balance'=> $balance]);

        $cachedKey = 'company.info.'.$companySymbol;
        $company = cache()->get($cachedKey);

        $trade = new Trade([
            'company' => $company->getName(),
            'company_symbol' => $company->getSymbol(),
            'buy_price' => $company->getPrice(),
            'amount_bought' => $stockAmount['amount']
        ]);
        $trade->user()->associate(auth()->user());

        $trade->save();

        event(new StockTradeEvent($trade));


        return redirect(route('user.trades'));
    }
    public function sell()
    {
        var_dump('PARDODAM');
    }

}
