<?php

namespace App\Models\Company;

class Company
{
    private string $name;
    private string $symbol;
    private ?string $stockType;
    private ?CompanyProfile $companyProfile;
    private ?CompanyRecommendation $recommendationTrend;


    public function __construct(string $name,
                                string $symbol,
                                ?string $stockType,
                                ?CompanyProfile $companyProfile = null,
                                ?CompanyRecommendation $recommendationTrend = null)
    {
        $this->name = $name;
        $this->symbol = $symbol;
        $this->stockType = $stockType ?? null;
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

    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    public function recommendationTrend(): CompanyRecommendation
    {
        return $this->recommendationTrend;
    }

    public function profile(): CompanyProfile
    {
        return $this->companyProfile;
    }
}
