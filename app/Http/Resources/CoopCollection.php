<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CoopCollection extends Resource
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
        ];
    }
}
