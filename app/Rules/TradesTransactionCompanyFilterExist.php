<?php

namespace App\Rules;

use App\Models\TradeTransaction;
use Illuminate\Contracts\Validation\Rule;

class TradesTransactionCompanyFilterExist implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return TradeTransaction::where('user_id', auth()->user()->id)
            ->where('company', $value)
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Wrong company filter input';
    }
}
