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
            'link' => route('cards.show', ['card' => $this->slug]),
            'card' => $this->image_url,
            'issued' => (float) $this->asset->issuance_normalized,
            'burned' => (float) $this->asset->burned_normalized,
            'supply' => (float) $this->asset->supply_normalized,
            'harvest' => $this->harvest_id,
            'harvest_ranking' => $this->meta_data['harvest_ranking'],
            'overall_ranking' => $this->meta_data['overall_ranking'],
        ];
    }
}
