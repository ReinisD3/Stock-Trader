<?php

namespace App\Services\ControllerServices\MarketNewsService;

use App\Repositories\StockRepository;
use Ramsey\Collection\Collection;

class MarketNewsService
{
    private StockRepository $repository;

    public function __construct(StockRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(string $newsCategory): Collection
    {
        $cachedKey = 'marketNews';

        if (cache()->has($cachedKey)) {

            return cache()->get($cachedKey);
        }
        $marketNews = $this->repository->getMarketNews($newsCategory);
        $marketNews->sort('getDateTime', 'desc');
        cache()->put($cachedKey, $marketNews, now()->addHours(3));

        return $marketNews;
    }
}
