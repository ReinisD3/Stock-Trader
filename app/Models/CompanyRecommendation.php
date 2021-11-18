<?php

namespace App\Models;

class CompanyRecommendation
{
    private int $buy;
    private int $sell;
    private int $hold;
    private string $period;

    public function __construct(
        int $buy,
        int $sell,
        int $hold,
        string $period)
    {
        $this->buy = $buy;
        $this->sell = $sell;
        $this->hold = $hold;
        $this->period = $period;
    }


    public function getBuy(): int
    {
        return $this->buy;
    }

    public function getSell(): int
    {
        return $this->sell;
    }

    public function getHold(): int
    {
        return $this->hold;
    }

    public function getPeriod(): string
    {
        return $this->period;
    }
}
