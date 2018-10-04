<?php

namespace App\Http\Resources;

use App\Http\Resources\FarmCollection;
use Illuminate\Http\Resources\Json\Resource;

class CoopResource extends Resource
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
            'slug' => $this->slug,
            'link' => $this->url,
            'description' => $this->content,
            'crops' => (float) $this->accessBalance(),
            'bitcorn' => (int) $this->rewardBalance(),
            'bitcorn_harvested' => (int) $this->total_harvested,
            'member_count' => $this->farms()->count(),
            'members' => FarmCollection::collection($this->farms),
        ];
    }
}
