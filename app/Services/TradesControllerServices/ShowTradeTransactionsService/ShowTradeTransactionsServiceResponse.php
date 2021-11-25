<?php

namespace App\Services\TradesControllerServices\ShowTradeTransactionsService;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ShowTradeTransactionsServiceResponse
{
    private LengthAwarePaginator $tradesTransactions;
    private Collection $companyList;
    private string $sortDirection;
    private string $companyFiltered;
    private string $transactionType;

    public function __construct(LengthAwarePaginator $tradesTransactions,
                                Collection $companyList,
                                string $sortDirection,
                                string $companyFiltered ,
                                string $transactionType )
    {
        $this->tradesTransactions = $tradesTransactions;
        $this->companyList = $companyList;
        $this->sortDirection = $sortDirection;
        $this->companyFiltered = $companyFiltered;
        $this->transactionType = $transactionType;
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

    public function getCompanyFiltered(): string
    {
        return $this->companyFiltered;
    }

    public function getTransactionType(): string
    {
        return $this->transactionType;
    }
}
