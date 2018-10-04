<?php

namespace App\Http\Resources;

use App\Http\Resources\CoopResource;
use App\Http\Resources\FarmBalanceCollection;
use App\Http\Resources\HarvestCollection;
use Illuminate\Http\Resources\Json\Resource;

class FarmResource extends Resource
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
            'name' => $this->display_name,
            'address' => $this->xcp_core_address,
            'description' => $this->display_content,
            'link' => $this->url,
            'farm' => $this->display_image_url,
            'access' => $this->access ? true : false,
            'coop' => new CoopResource($this->coop),
            'tokens' => FarmBalanceCollection::collection($this->tokenBalances),
            'cards' => FarmBalanceCollection::collection($this->upgradeBalances),
            'harvests' => FarmHarvestCollection::collection($this->harvests),
            'position' => [
                'lat' => $this->mapMarker ? (float) $this->mapMarker->latitude : null,
                'lng' => $this->mapMarker ? (float) $this->mapMarker->longitude : null,
            ],
        ];
    }
}
