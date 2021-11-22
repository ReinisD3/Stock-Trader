<?php

namespace App\Services\TradesControllerServices\SellIndexService;

use App\Models\Company\Company;
use App\Models\Trade\Trade;

class SellIndexResponse
{
    private Company $company;
    private Trade $trade;
    private float $currentPrice;

    public function __construct(Company $company, Trade $trade, float $currentPrice)
    {
        $this->company = $company;
        $this->trade = $trade;
        $this->currentPrice = $currentPrice;
    }

    public function getCompany(): Company
    {
        return $this->company;
    }

    public function getTrade(): Trade
    {
        return $this->trade;
    }

    public function getCurrentPrice(): float
    {
        return $this->currentPrice;
    }
}
