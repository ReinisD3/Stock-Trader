<?php

namespace App\Http\Controllers;


use App\Events\FundsWereDeposited;
use App\Models\Trade;
use App\Models\User;
use App\Repositories\FinhubRepository;
use App\Repositories\StockRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserController extends Controller
{
    private $repository;

    public function __construct(StockRepository $repository)
    {
        $this->repository = $repository;

    }
    public function showProfile():View
    {
        return view('user.profile', ['user'=>auth()->user()]);
    }
    public function deposit()
    {
        $deposit = request()->validate([
            'amount' => ['required', 'numeric']
        ]);
       $user = User::find(Auth::id());
       $total = $user->balance + (int) $deposit['amount'];
       $user->update(['balance' => $total]);

       event(new FundsWereDeposited($deposit['amount'], $user->email));

       return Redirect::route('user.profile');
    }
    public function showTrades()
    {
        $trades = Trade::where('user_id',auth()->user()->id)
            ->orderBy('created_at' , 'DESC')
            ->get();
        $currentPrices = [];
        foreach ($trades as $trade){
           if(!isset($currentPrices[$trade->company_symbol])){
               $currentPrices[$trade->company_symbol]= $this->repository->getPrice($trade->company_symbol);
           }
            $currentPrices['profit'.$trade->id] = round($currentPrices[$trade->company_symbol] - $trade->buy_price,2);
        }

        return view('user.trades',['trades' => $trades , 'currentPrices' => $currentPrices]);
    }
}
