<?php

namespace App\Services\TradesControllerServices\SellIndexService;


use App\Http\Requests\SellCompanyStockRequest;
use App\Models\Trade\Trade;
use App\Repositories\StockRepository;


class SellIndexService
{
    private StockRepository $repository;

    public function __construct(StockRepository $repository)
    {
        $this->repository = $repository;
    }
    public function handle(Trade $trade):SellIndexResponse
    {
        $companySymbol = $trade->company_symbol;
        $currentStockPrice = $this->repository->getPrice($companySymbol);

        $cachedKey = 'company.info.' . $companySymbol;
        if (cache()->has($cachedKey)) {
            $company = cache()->get($cachedKey);
        } else {
            $company = $this->repository->getCompanyInfo($companySymbol);
            cache()->put($cachedKey, $company);
        }

        return new SellIndexResponse($company,$trade,$currentStockPrice);
    }
}
