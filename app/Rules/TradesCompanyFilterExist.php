<?php

namespace App\Rules;

use App\Models\Trade\Trade;
use Illuminate\Contracts\Validation\Rule;

class TradesCompanyFilterExist implements Rule
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
        return Trade::where('user_id', auth()->user()->id)
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
        return 'No such company in your table';
    }
}
