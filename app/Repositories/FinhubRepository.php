<?php

namespace App\Repositories;


use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\CompanyRecommendation;
use Finnhub\Api\DefaultApi;
use Ramsey\Collection\Collection;

class FinhubRepository implements StockRepository
{
    private $client;

    public function __construct(DefaultApi $client)
    {
        $this->client = $client;
    }
    public function searchCompanies(string $name) : Collection
    {
       $companies= $this->client->symbolSearch($name);
       $collection = new Collection(Company::class);
       foreach ($companies['result'] as $company)
       {
            $collection->add(
                new Company(
                    $company['description'],
                    $company['symbol'],
                    $company['type']
                    ));
       }
       return $collection;
    }
    public function getPrice(string $companySymbol):float
    {
        return $this->client->quote($companySymbol)['c'];
    }
    public function getCompanyInfo(string $companySymbol):Company
    {
       $companyProfile = $this->client->companyProfile2($companySymbol);
       $companyRecommendationTrend = ($this->client->recommendationTrends($companySymbol))[0];

       return new Company(
           $companyProfile->getName(),
           $companySymbol,
           null,
          new CompanyProfile(
              $companyProfile->getCountry(),
              $companyProfile->getCurrency(),
              $companyProfile->getExchange(),
              $companyProfile->getFinnhubIndustry(),
              $companyProfile->getLogo(),
              $companyProfile->getWeburl()
          ),
           new CompanyRecommendation(
               $companyRecommendationTrend->getBuy(),
               $companyRecommendationTrend->getSell(),
               $companyRecommendationTrend->getHold(),
               $companyRecommendationTrend->getPeriod()
           )
       );
    }
}
