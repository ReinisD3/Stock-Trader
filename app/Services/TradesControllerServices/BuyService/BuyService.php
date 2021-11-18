<?php

namespace App\Services\TradesControllerServices\BuyService;

use App\Events\StockTradeEvent;
use App\Models\Trade;
use App\Models\User;
use App\Repositories\StockRepository;
use Illuminate\Support\Facades\Auth;

class BuyService
{
    private StockRepository $repository;

    public function __construct(StockRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(string $companySymbol): void
    {
        $user = User::find(Auth::id());
        $stockPrice = $this->repository->getPrice($companySymbol);
        $stockAmount = request()->validate([
            'amount' => ['required', 'integer']
        ]);
        $stockAmount['amount'] = (int)$stockAmount['amount'];

        $balance = $user->balance - $stockAmount['amount']*$stockPrice;

        $user->update(['balance' => $balance]);

        $cachedKey = 'company.info.' . $companySymbol;
        $company = cache()->get($cachedKey);

        $trade = new Trade([
            'company' => $company->getName(),
            'company_symbol' => $companySymbol,
            'buy_price' => $stockPrice,
            'amount_bought' => $stockAmount['amount']
        ]);
        $trade->user()->associate(auth()->user());
        $trade->save();

        event(new StockTradeEvent($trade, $user));
    }
}
