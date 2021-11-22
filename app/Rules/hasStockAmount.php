<?php

namespace App\Rules;

use App\Models\Trade\Trade;
use Illuminate\Contracts\Validation\Rule;

class hasStockAmount implements Rule
{


    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

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
        return $value <= request('trade')->amount_bought;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "You don't have that many stock";
    }
}
