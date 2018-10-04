<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CardCollection extends Resource
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
            'link' => $this->url,
            'card' => $this->image_url,
            'issued' => (float) $this->asset->issuance_normalized,
            'burned' => (float) $this->asset->burned_normalized,
            'supply' => (float) $this->asset->supply_normalized,
        ];
    }
}
