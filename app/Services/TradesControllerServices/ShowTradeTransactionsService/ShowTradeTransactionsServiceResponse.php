<?php

namespace App\Services\TradesControllerServices\ShowTradeTransactionsService;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ShowTradeTransactionsServiceResponse
{
    private LengthAwarePaginator $tradesTransactions;
    private Collection $companyList;
    private string $sortDirection;

    public function __construct(LengthAwarePaginator $tradesTransactions, Collection $companyList, string $sortDirection)
    {
        $this->tradesTransactions = $tradesTransactions;
        $this->companyList = $companyList;
        $this->sortDirection = $sortDirection;
    }

    public function geTradesTransactions(): LengthAwarePaginator
    {
        return $this->tradesTransactions;
    }

    public function getCompanyList(): Collection
    {
        return $this->companyList;
    }

    public function getSortDirection(): string
    {
        return $this->sortDirection;
    }
}
