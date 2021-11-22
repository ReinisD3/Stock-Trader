<?php

namespace App\TradeCalculator;


use App\Models\Trade\Trade;

use App\Repositories\StockRepository;
use Illuminate\Database\Eloquent\Collection;


class TradeCalculator
{
    private StockRepository $repository;

    public function __construct(StockRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addCalculationsToTrades(Collection $trades): Collection
    {
        foreach ($trades as $trade) {

            $companySymbol = $trade->company_symbol;
            $currentPrice = $this->repository->getPrice($companySymbol);
            $profit = $this->calculateProfit($trade->amount_bought, $trade->buy_price, $currentPrice);

            $trade->profit = $profit;
            $trade->profit_to_investment = $this->calculateProfitToInvestment($trade->usd_invested, $profit);
            $trade->current_price = $currentPrice;
        }

        return $trades;
    }

    public function calculateProfit(int $amount,float $buyPrice, float $currentPrice): float
    {
        return round(($currentPrice - $buyPrice) * $amount, 2);
    }

    public function calculateProfitToInvestment(float $usdInvested, float $profit): float
    {
        return round(($profit / $usdInvested) * 100, 2);
    }
    public function getAverageBuyPrice(Trade $mainTrade, int $addAmount, float $addPrice):float
    {
        $totalInvestment = $mainTrade->usd_invested+$addAmount*$addPrice;
        $totalAmount = $mainTrade->amount_bought+$addAmount;
        return round($totalInvestment/$totalAmount,2);
    }

}
