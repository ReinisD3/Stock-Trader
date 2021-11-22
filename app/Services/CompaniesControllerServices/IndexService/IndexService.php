<?php

namespace App\Services\CompaniesControllerServices\IndexService;

use App\Models\Company\CompanySymbol;
use Illuminate\Database\Eloquent\Collection;

class IndexService
{
    public function handle():Collection
    {
        return CompanySymbol::all();
    }
}
