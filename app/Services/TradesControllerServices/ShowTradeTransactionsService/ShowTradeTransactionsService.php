<?php

namespace App\Services\TradesControllerServices\ShowTradeTransactionsService;

use App\Http\Requests\ShowTradeTransactionsRequest;
use App\Models\TradeTransaction;

class ShowTradeTransactionsService
{
    public function handle(ShowTradeTransactionsRequest $request)
    {
        $userId = auth()->user()->id;
        $filter = $request->toArray();
        $sortDirection = 'desc';

        $tradesTransactions = TradeTransaction::filter($filter, $userId)
            ->paginate(10);

        if (isset($filter['sortDirection']))
            $sortDirection = $filter['sortDirection'] === 'desc' ? 'asc' : 'desc';


        $companyList = TradeTransaction::where('user_id', $userId)
            ->select('company')
            ->groupBy('company')
            ->get();


        return new ShowTradeTransactionsServiceResponse($tradesTransactions, $companyList, $sortDirection);
    }

}
