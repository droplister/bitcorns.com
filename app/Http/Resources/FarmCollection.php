<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class FarmCollection extends Resource
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
            'coop' => $this->coop ? $this->coop->name : null,
            'cards' => $this->upgrade_balances_count,
            'access' => $this->access,
        ];
    }
}
