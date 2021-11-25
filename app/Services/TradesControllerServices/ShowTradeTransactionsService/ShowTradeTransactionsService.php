<?php

namespace App\Services\TradesControllerServices\ShowTradeTransactionsService;

use App\Http\Requests\ShowTradeTransactionsRequest;
use App\Models\TradeTransaction;

class ShowTradeTransactionsService
{
    public function handle(ShowTradeTransactionsRequest $request,int $userId)
    {
        $filter = $request->toArray();

        if (isset($filter['sortDirection'])) {
            $sortDirection = $filter['sortDirection'] === 'desc' ? 'asc' : 'desc';
        } else {
            $sortDirection = 'desc';
            $filter['sortDirection'] = 'desc';
        }

        $tradesTransactions = TradeTransaction::filter($filter, $userId)
            ->paginate(10);

        $companyList = TradeTransaction::where('user_id', $userId)
            ->select('company')
            ->groupBy('company')
            ->get();
        $companyFiltered = $filter['companyFilter'] ?? '';
        $transactionType = $filter['transactionType'] ?? '';

        return new ShowTradeTransactionsServiceResponse(
            $tradesTransactions,
            $companyList,
            $sortDirection,
            $companyFiltered,
            $transactionType
        );
    }

}
