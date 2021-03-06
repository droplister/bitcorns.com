<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TokenBalanceCollection extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'address' => $this->farm->xcp_core_address,
            'balance' => (float) $this->quantity_normalized,
        ];
    }
}
