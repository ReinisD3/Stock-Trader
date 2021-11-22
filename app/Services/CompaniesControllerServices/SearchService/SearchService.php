<?php

namespace App\Services\CompaniesControllerServices\SearchService;

use App\Repositories\StockRepository;
use Illuminate\Http\Request;
use Ramsey\Collection\Collection;

class SearchService
{
    private StockRepository $repository;

    public function __construct(StockRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(Request $request): Collection
    {
        $request->validate(['company' => 'required']);

        $companyName = strtolower($request['company']);
        $cachedKey = 'companies.search.' . $companyName;

        if (cache()->has($cachedKey)) {
           return cache()->get($cachedKey);
        }
        $companies = $this->repository->searchCompanies($companyName);
        cache()->put($cachedKey, $companies);

        return $companies;

    }
}
