<?php

namespace App\Providers;

use App\Repositories\FinhubRepository;
use App\Repositories\StockRepository;
use Finnhub\Api\DefaultApi;
use Finnhub\Configuration;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StockRepository::class, function () {
            $config = Configuration::getDefaultConfiguration()->setApiKey('token',env('FINNHUB_API_KEY'));
            $client = new DefaultApi(
                new GuzzleHttp\Client(),
                $config
            );
            return new FinhubRepository($client);
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
