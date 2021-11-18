<?php

namespace App\Services\UsersControllerServices\ShowTradesService;



use Illuminate\Database\Eloquent\Collection;

class ShowTradesResponse
{
    private Collection $trades;
    private array $currentPrices;
    private array $currentProfits;

    public function __construct(Collection $trades, array $currentPrices, array $currentProfits)
    {
        $this->trades = $trades;
        $this->currentPrices = $currentPrices;
        $this->currentProfits = $currentProfits;
    }

    public function getTrades(): Collection
    {
        return $this->trades;
    }

    public function getCurrentPrices(): array
    {
        return $this->currentPrices;
    }

    public function getCurrentProfits(): array
    {
        return $this->currentProfits;
    }

}
