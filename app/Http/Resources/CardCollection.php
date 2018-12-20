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
        $route = $this->approved_at && ! $this->published_at ? 'api.publish.card' : 'cards.show';

        return [
            'name' => $this->name,
            'link' => route($route, ['card' => $this->slug]),
            'card' => $this->image_url,
            'issued' => (float) $this->asset->issuance_normalized,
            'burned' => (float) $this->asset->burned_normalized,
            'supply' => (float) $this->asset->supply_normalized,
            'harvest' => $this->harvest_id,
            'harvest_ranking' => isset($this->meta_data['harvest_ranking']) ? $this->meta_data['harvest_ranking'] : null,
            'overall_ranking' => isset($this->meta_data['overall_ranking']) ? $this->meta_data['overall_ranking'] : null,
        ];
    }
}
