<?php

namespace App\Services\TradesControllerServices\ShowTradesService;

use Illuminate\Database\Eloquent\Collection;

class ShowTradesResponse
{
    private Collection $trades;
    private Collection $companyList;
    private string $sortDirection;

    public function __construct(Collection $trades, Collection $companyList, string $sortDirection)
    {
        $this->trades = $trades;
        $this->companyList = $companyList;
        $this->sortDirection = $sortDirection;
    }

    public function getTrades(): Collection
    {
        return $this->trades;
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
