<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class stockMarketIsOpen implements Rule
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
        $time = now(config('openMarketTimes.timeZone'))->toTimeString('minute');
        return $time > config('openMarketTimes.marketOpens') && $time < config('openMarketTimes.marketCloses');

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Stock market is closed';
    }
}
