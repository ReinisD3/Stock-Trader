<?php

namespace App\Rules;

use App\Repositories\StockRepository;
use Illuminate\Contracts\Validation\Rule;

class hasEnoughFunds implements Rule
{

    private StockRepository $repository;

    public function __construct(StockRepository $repository)
    {

        $this->repository = $repository;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value):bool
    {
        return $value*$this->repository->getPrice((request()->get('companySymbol'))) < auth()->user()->balance;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message():string
    {
        return "Not enough Funds in your Balance";
    }
}
