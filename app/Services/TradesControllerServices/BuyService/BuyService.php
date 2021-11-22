<?php

namespace App\Services\TradesControllerServices\BuyService;

use App\Events\StockTradeEvent;
use App\Models\Trade\Trade;
use App\Models\TradeTransaction;
use App\Models\User;
use App\Repositories\StockRepository;
use App\TradeCalculator\TradeCalculator;
use Illuminate\Support\Facades\Auth;

class BuyService
{
    private StockRepository $repository;
    private TradeCalculator $tradeCalculator;

    public function __construct(StockRepository $repository,
                                TradeCalculator $tradeCalculator)
    {
        $this->repository = $repository;
        $this->tradeCalculator = $tradeCalculator;
    }

    public function handle(array $request, string $companySymbol): void
    {
        $user = User::find(Auth::id());
        $stockPrice = $this->repository->getPrice($companySymbol);

        $balance = $user->balance - $request['amount'] * $stockPrice;
        $user->update(['balance' => $balance]);


        $trade = Trade::where(['user_id' => $user->id])
            ->where(['company_symbol' => $companySymbol])->first();
        if ($trade) {
            $trade->update([
                'buy_price' => $this->tradeCalculator
                    ->getAverageBuyPrice($trade, $request['amount'], $stockPrice),
                'amount_bought' => $trade->amount_bought + $request['amount'],
                'usd_invested' => $trade->usd_invested + ($stockPrice * $request['amount']),
            ]);
        } else {
            $cachedKey = 'company.info.' . $companySymbol;
            $company = cache()->get($cachedKey);
            $trade = new Trade([
                'company' => $company->getName(),
                'company_symbol' => $companySymbol,
                'buy_price' => $stockPrice,
                'amount_bought' => $request['amount'],
                'usd_invested' => $stockPrice * $request['amount']
            ]);
            $trade->user()->associate($user);
            $trade->save();

        }
        $tradeTransaction = TradeTransaction::create
        ([
            'user_id' => $trade->user_id,
            'company' => $trade->company,
            'company_symbol' => $trade->company_symbol,
            'buy_price' => $trade->buy_price,
            'amount_bought' => $request['amount'],
            'usd_invested' => $request['amount']*$stockPrice,
            'bought_at' => $trade->created_at
        ]);

        event(new StockTradeEvent($tradeTransaction, $user));

    }
}
