<?php

namespace App\Http\Controllers;

use App\Services\CompaniesControllerServices\CompanyInfoService\CompanyInfoService;
use App\Services\CompaniesControllerServices\SearchService\SearchService;
use Illuminate\Http\Request;
use Illuminate\View\View;


class CompaniesController extends Controller
{
    private SearchService $searchService;
    private CompanyInfoService $companyInfoService;

    public function __construct(SearchService $searchService, CompanyInfoService $companyInfoService)
    {
        $this->searchService = $searchService;
        $this->companyInfoService = $companyInfoService;
    }

    public function index(): View
    {
        return view('companies.index');
    }

    public function searchCompanies(Request $request): View
    {
        $companies = $this->searchService->handle($request);

        return view('companies.index', ['companies' => $companies]);
    }

    public function companyInfo(string $companySymbol)
    {
        $response = $this->companyInfoService->handle($companySymbol);

        return view('companies.companyInfo', [
            'company' => $response->getCompany(),
            'price' => $response->getStockPrice(),
            'userBalance' => $response->getUserBalance()
        ]);

    }
}
