<?php

namespace App\Traits;

use Exception;
use BitWasp\Bitcoin\Address\AddressCreator;
use BitWasp\Bitcoin\Address\PayToPubKeyHashAddress;
use BitWasp\Bitcoin\Crypto\EcAdapter\EcSerializer;
use BitWasp\Bitcoin\Crypto\EcAdapter\Serializer\Signature\CompactSignatureSerializerInterface;
use BitWasp\Bitcoin\MessageSigner\MessageSigner;
use BitWasp\Bitcoin\Serializer\MessageSigner\SignedMessageSerializer;
use App\Http\Requests\Farms\UpdateRequest;

trait Signable
{
    /**
     * Verify Signature
     *
     * @param  \App\Http\Requests\Farms\UpdateRequest  $request
     * @return mixed
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
    public function guardAgainstInvalidSignature(UpdateRequest $request)
    {
        // Based on
        // https://github.com/Bit-Wasp/bitcoin-php/blob/1.0/examples/signedmessage.verify.php
        try {
            $sig = '-----BEGIN BITCOIN SIGNED MESSAGE----- ' . $request->message . ' -----BEGIN SIGNATURE-----
            '. $request->signature .'
            -----END BITCOIN SIGNED MESSAGE-----';

            $addrCreator = new AddressCreator();
            $address = $addrCreator->fromString($this->xcp_core_address);

            $compactSigSerializer = EcSerializer::getSerializer(CompactSignatureSerializerInterface::class);
            $serializer = new SignedMessageSerializer($compactSigSerializer);

            $signedMessage = $serializer->parse($sig);
            $signer = new MessageSigner();

            if ($signer->verify($signedMessage, $address)) {
                // Valid Sig
            } else {
                return true;
            }
        } catch (Exception $e) {
            return true; // Errors
        }

        // No issues
        return false;
    }
}
