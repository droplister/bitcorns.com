<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MapMarkerResource extends Resource
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
            'name' => $this->farm->display_name,
            'href' => route('farms.show', ['farm' => $this->farm->slug]),
            'options' => $this->settings['options'],
            'position' => [
                'lat' => (float) $this->latitude,
                'lng' => (float) $this->longitude,
            ],
            'radius' => round($this->farm->map_radius),
        ];
    }
}
