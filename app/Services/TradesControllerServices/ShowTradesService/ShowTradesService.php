<?php

namespace App\Services\TradesControllerServices\ShowTradesService;

use App\Http\Requests\ShowTradesRequest;
use App\Models\Trade\Trade;
use App\TradeCalculator\TradeCalculator;


class ShowTradesService
{
    private TradeCalculator $tradesCalculator;

    public function __construct(TradeCalculator $tradesCalculator)
    {
        $this->tradesCalculator = $tradesCalculator;
    }

    public function handle(ShowTradesRequest $request, int $userId): ShowTradesResponse
    {
        $sortDirection = 'desc';
        $filter = $request->toArray();

        $trades = Trade::filter($filter, $userId)
            ->get();
        $sortedTradesWithCalculations = $this->tradesCalculator->addCalculationsToTrades($trades);

        if (isset($filter['sortBy'])) {
            if($filter['sortDirection'] === 'desc'){
                $sortedTradesWithCalculations = $sortedTradesWithCalculations->sortByDesc($filter['sortBy']);
                $sortDirection = 'asc';
            }
            if($filter['sortDirection'] === 'asc'){
                $sortedTradesWithCalculations = $sortedTradesWithCalculations->sortBy($filter['sortBy']);
                $sortDirection = 'desc';
            }
        }
        $companyList = Trade::where('user_id', $userId)
            ->select('company')
            ->groupBy('company')
            ->get();


        return new ShowTradesResponse($sortedTradesWithCalculations, $companyList, $sortDirection);


    }
}
