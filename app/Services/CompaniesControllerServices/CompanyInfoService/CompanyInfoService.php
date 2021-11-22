<?php

namespace App\Services\CompaniesControllerServices\CompanyInfoService;

use App\Models\Company\CompanySymbol;
use App\Models\User;
use App\Repositories\StockRepository;
use Illuminate\Support\Facades\Auth;

class CompanyInfoService
{
    private StockRepository $repository;

    public function __construct(StockRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(string $companySymbol): CompanyInfoResponse
    {

        $currentStockPrice = $this->repository->getPrice($companySymbol);
        $userBalance = (User::find(Auth::id()))->balance;

        $cachedKey = 'company.info.' . $companySymbol;
        if (cache()->has($cachedKey)) {
            $company = cache()->get($cachedKey);
        } else {
            $company = $this->repository->getCompanyInfo($companySymbol);
            cache()->put($cachedKey, $company);
        }
        // Storing companies logos in DB for easy search
        CompanySymbol::firstOrCreate(['name' => $company->getName(),
            'symbol' => $company->getSymbol(),
            'logo' => $company->profile()->getLogo()]);

        return new CompanyInfoResponse($company, $currentStockPrice, $userBalance);
    }
}
