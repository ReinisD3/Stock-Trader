<?php

namespace App\Http\Requests;

use App\Repositories\StockRepository;
use App\Rules\hasEnoughFunds;
use App\Rules\stockMarketIsOpen;
use Illuminate\Foundation\Http\FormRequest;

class BuyCompanyStockRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(StockRepository $repository)
    {
        return [
            'amount' => ['required', 'integer', 'min:1', new hasEnoughFunds($repository) , new stockMarketIsOpen ]
        ];
    }
}
