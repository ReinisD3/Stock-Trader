<?php

namespace App\Repositories;

use App\Models\Company;
use Ramsey\Collection\Collection;


Interface StockRepository
{
    public function searchCompanies(string $name):Collection;
    public function getPrice(string $companySymbol):float;
    public function getCompanyInfo(string $companySymbol):Company;
}
