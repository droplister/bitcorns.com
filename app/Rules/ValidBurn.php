<?php

namespace App\Rules;

use Droplister\XcpCore\App\Send;
use Illuminate\Contracts\Validation\Rule;

class ValidBurn implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Get Send
        $send = Send::where('tx_hash', '=', $value)->first();

        // Check it!
        return $send && $send->status === 'valid' && $send->destination === config('bitcorn.subfee_address');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Burn TX invalid and/or wrong destination.';
    }
}