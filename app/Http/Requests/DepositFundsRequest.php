<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositFundsRequest extends FormRequest
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

    public function rules()
    {
        return [
            'depositAmount' => ['required', 'numeric', 'between:1,2000']
        ];
    }
}
