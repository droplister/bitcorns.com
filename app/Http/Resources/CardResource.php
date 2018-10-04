<?php

namespace App\Http\Resources;

use App\Http\Resources\TokenBalanceCollection;
use Illuminate\Http\Resources\Json\Resource;

class CardResource extends Resource
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
            'issued' => $this->asset->issuance_normalized,
            'burned' => $this->asset->burned_normalized,
            'supply' => $this->asset->supply_normalized,
            'holder_count' => $this->farms()->count(),
            'holders' => TokenBalanceCollection::collection($this->farms),
        ];
    }
}
