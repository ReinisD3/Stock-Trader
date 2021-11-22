<?php

namespace App\Models;

class MarketNews
{
    private string $headline;
    private int $dateTime;
    private string $image;
    private string $source;
    private string $url;
    private string $summary;

    public function __construct(string $headline,
                                int    $dateTime,
                                string $image,
                                string $source,
                                string $url,
                                string $summary)
    {
        $this->headline = $headline;
        $this->dateTime = $dateTime;
        $this->image = $image;
        $this->source = $source;
        $this->url = $url;
        $this->summary = $summary;
    }

    public function getHeadline(): string
    {
        return $this->headline;
    }

    public function getDateTime(): int
    {
        return $this->dateTime;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }
}
