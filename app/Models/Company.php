<?php

namespace App\Models;

class Company
{
    private $name;
    private $symbol;
    private $stockType;
    private $price;
    private $recommendationTrend;
    private $companyProfile;

    public function __construct(string $name,
                                string $symbol,
                                ?string $stockType = null,
                                ?object $companyProfile = null,
                                ?float $price = null,
                                ?object $recommendationTrend = null)
    {
        $this->name = $name;
        $this->symbol = $symbol;
        $this->stockType = $stockType;
        $this->price = $price;
        $this->recommendationTrend = $recommendationTrend;
        $this->companyProfile = $companyProfile;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getStockType(): string
    {
        return $this->stockType;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    public function recommendationTrend(): object
    {
        return $this->recommendationTrend;
    }

    public function profile(): object
    {
        return $this->companyProfile;
    }
}
