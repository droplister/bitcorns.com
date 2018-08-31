<?php

namespace App\Traits;

use Throwable;
use Carbon\Carbon;
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
        // Validate Timestamp
        if($this->guardAgainstInvalidTimestamp($request))
        {
            return 'Invalid Timestamp';
        }

        // Validate Signature
        if($this->guardAgainstInvalidSignature($request))
        {
            return 'Invalid Signature';
        }

        // No issues
        return false;
    }

    /**
     * Guard Against Invalid Timestamp
     * 
     * @param  \App\Http\Requests\Farms\UpdateRequest  $request
     * @return boolean
     */
    private function guardAgainstInvalidTimestamp(UpdateRequest $request)
    {
        try
        {
            // Carbon
            $timestamp = Carbon::parse($request->timestamp);

            // 1-hour (or less)
            if($timestamp < Carbon::now()->subHour())
            {
                return true; // Too old
            }
        }
        catch(Throwable $e)
        {
            return true; // Invalid
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
        try
        {
            // Bitcoin Lib
            $messageVerification = BitcoinLib::verifyMessage(
                $this->xcp_core_address,
                $request->signature,
                $request->timestamp
            );

            // Verification
            if(! $messageVerification)
            {
                return true; // Invalid
            }
        }
        catch(Throwable $e)
        {
            return true; // Errors
        }

        // No issues
        return false;
    }
}