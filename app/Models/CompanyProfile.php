<?php

namespace App\Models;

class CompanyProfile
{

    private string $country;
    private string $currency;
    private string $exchange;
    private string $finnhubIndustry;
    private string $logo;
    private string $webUrl;

    public function __construct(
        string $country,
        string $currency,
        string $exchange,
        string $finnhubIndustry,
        string $logo,
        string $webUrl
    )
    {

        $this->country = $country;
        $this->currency = $currency;
        $this->exchange = $exchange;
        $this->finnhubIndustry = $finnhubIndustry;
        $this->logo = $logo;
        $this->webUrl = $webUrl;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getExchange(): string
    {
        return $this->exchange;
    }

    public function getFinnhubIndustry(): string
    {
        return $this->finnhubIndustry;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function getWebUrl(): string
    {
        return $this->webUrl;
    }
}
