<?php

namespace App\Traits;

use Exception;
use BitWasp\BitcoinLib\BitcoinLib;
use App\Http\Requests\Farms\UpdateRequest;

trait Signable
{
    /**
     * Verify Signature
     *
     * @param  \App\Http\Requests\Farms\UpdateRequest  $request
     */
    public function validateSignature(UpdateRequest $request)
    {
        // Validate Signature
        if ($this->guardAgainstInvalidSignature($request)) {
            return 'Invalid Signature';
        }

        // No issues
        return false;
    }

    /**
     * Guard Against Invalid Signature
     *
     * @param  \App\Http\Requests\Farms\UpdateRequest  $request
     * @return boolean
     */
    private function guardAgainstInvalidSignature(UpdateRequest $request)
    {
        try {
            // Bitcoin Lib
            $messageVerification = BitcoinLib::verifyMessage(
                $this->xcp_core_address,
                $request->message,
                $request->timestamp
            );

            // Verification
            if (! $messageVerification) {
                return true; // Invalid
            }
        } catch (Exception $e) {
            return true; // Errors
        }

        // No issues
        return false;
    }
}
