<?php
namespace App\Models\Collections;

use App\Models\Company;

class CompaniesCollection
{
    private $companies;
    public function __construct(Company ...$company)
    {
        $this->companies = $company;
    }
    public function addCompany(Company $company):void
    {
        $this->companies[] = $company;
    }

    public function getCompanies(): array
    {
        return $this->companies;
    }
}
