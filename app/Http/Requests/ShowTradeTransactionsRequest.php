<?php

namespace App\Http\Requests;

use App\Rules\TradesTransactionCompanyFilterExist;
use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Nullable;

class ShowTradeTransactionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'companyFilter' => [new TradesTransactionCompanyFilterExist(), 'nullable'] ,
            'sortBy' => ['in:usd_invested,profit,profit_to_investment','nullable'] ,
            'sortDirection' => ['in:asc,desc','nullable'],
           'transactionType' =>['in:buy,sell,all', 'nullable']
        ];
    }
}
