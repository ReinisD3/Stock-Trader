<?php

namespace App\Http\Requests;

use App\Rules\hasStockAmount;
use App\Rules\stockMarketIsOpen;
use Illuminate\Foundation\Http\FormRequest;

class SellCompanyStockRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'amount' => ['required', 'integer', 'min:1', new hasStockAmount(), new stockMarketIsOpen]
        ];
    }
}
