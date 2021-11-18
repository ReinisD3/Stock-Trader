<?php

namespace App\Services\UsersControllerServices\ShowTradesService;


use App\Models\Trade;
use App\Repositories\StockRepository;

class ShowTradesService
{
    private StockRepository $repository;

    public function __construct(StockRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(int $userId): ShowTradesResponse
    {
        $trades = Trade::where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->get();
        $currentPrices = [];
        $currentProfits = [];
        foreach ($trades as $trade) {
            $companySymbol = $trade->company_symbol;
            if (!isset($currentPrices[$companySymbol])) {
                $currentPrices[$companySymbol] = $this->repository->getPrice($companySymbol);
            }
            $profit = ($currentPrices[$companySymbol] - $trade->buy_price) * $trade->amount_bought;
            $currentProfits[$trade->id] = round($profit, 2);
        }
        return new ShowTradesResponse($trades, $currentPrices, $currentProfits);
    }
}
