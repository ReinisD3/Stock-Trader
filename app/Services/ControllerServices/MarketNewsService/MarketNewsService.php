<?php

namespace App\Services\ControllerServices\MarketNewsService;

use App\Repositories\StockRepository;
use Ramsey\Collection\Collection;

class MarketNewsService
{


    public function handle(): Collection
    {
        $cachedKey = 'marketNews';


        return cache()->get($cachedKey);


    }
}
