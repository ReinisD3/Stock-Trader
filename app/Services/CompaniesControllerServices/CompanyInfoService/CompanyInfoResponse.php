<?php

namespace App\Services\CompaniesControllerServices\CompanyInfoService;

use App\Models\Company\Company;

class CompanyInfoResponse
{
    private Company $company;
    private float $stockPrice;
    private float $userBalance;

    public function __construct(Company $company, float $stockPrice, float $userBalance)
    {
        $this->company = $company;
        $this->stockPrice = $stockPrice;
        $this->userBalance = $userBalance;
    }

    public function getCompany(): Company
    {
        return $this->company;
    }

    public function getStockPrice(): float
    {
        return $this->stockPrice;
    }

    public function getUserBalance(): float
    {
        return $this->userBalance;
    }
}
