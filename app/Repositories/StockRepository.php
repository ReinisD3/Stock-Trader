<?php

namespace App\Repositories;

use App\Models\Company\Company;
use Ramsey\Collection\Collection;


interface StockRepository
{
    public function getMarketNews(string $newsCategory): Collection;

    public function searchCompanies(string $name): Collection;

    public function getPrice(string $companySymbol): float;

    public function getCompanyInfo(string $companySymbol): Company;
}
