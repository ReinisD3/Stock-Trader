<?php

namespace App\Services\TradesControllerServices\SellService;

use App\Events\SellTradeEvent;
use App\Http\Requests\SellCompanyStockRequest;
use App\Models\Trade\Trade;
use App\Models\TradeTransaction;
use App\Models\User;
use App\Repositories\StockRepository;
use App\TradeCalculator\TradeCalculator;

class SellService
{
    private StockRepository $repository;
    private TradeCalculator $tradeCalculator;

    public function __construct(StockRepository $repository,
                                TradeCalculator $tradeCalculator)
    {
        $this->repository = $repository;
        $this->tradeCalculator = $tradeCalculator;
    }

    public function handle(SellCompanyStockRequest $request, Trade $trade): void
    {
        $sellPrice = $this->repository->getPrice($trade->company_symbol);
        $profit = $this->tradeCalculator->calculateProfit($request['amount'], $trade->buy_price, $sellPrice);
        $profitToInvestment = $this->tradeCalculator
            ->calculateProfitToInvestment($request['amount'] * $trade->buy_price, $profit);

        $tradeTransaction = TradeTransaction::create([
            'user_id' => $trade->user_id,
            'company' => $trade->company,
            'company_symbol' => $trade->company_symbol,
            'buy_price' => $trade->buy_price,
            'sell_price' => $sellPrice,
            'amount_bought' => $request['amount'],
            'usd_invested' => $request['amount'] * $sellPrice,
            'profit' => $profit,
            'profit_to_investment' => $profitToInvestment,
            'sold_at' => now()->toDateTime(),
            'bought_at' => $trade->created_at
        ]);

        if ($trade->amount_bought === $request['amount']) {
            $trade->delete();
        } else {
            $amountLeft = $trade->amount_bought - $request['amount'];
            $trade->update(['amount_bought' => $amountLeft,
                'usd_invested' => $trade->buy_price * $amountLeft]);
        }

        $user = User::find(auth()->user()->id);
        $user->update(['balance' => $user->balance + $request['amount'] * $sellPrice]);

        event(new SellTradeEvent($tradeTransaction, $user));

    }
}
