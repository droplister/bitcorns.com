<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TokenCollection extends Resource
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
            'name' => $this->name,
            'type' => $this->type,
            'issued' => $this->asset->issuance_normalized,
            'burned' => $this->asset->burned_normalized,
            'supply' => $this->asset->supply_normalized,
            'divisible' => $this->asset->divisible,
            'locked' => $this->asset->locked,
        ];
    }
}
