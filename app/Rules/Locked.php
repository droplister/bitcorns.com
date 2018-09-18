<?php

namespace App\Rules;

use Droplister\XcpCore\App\Asset;
use Illuminate\Contracts\Validation\Rule;

class Locked implements Rule
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
        // Get Asset
        $asset = Asset::find($value);

        // Check it!
        return $asset && $asset->locked;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Asset issuance must be locked.';
    }
}