<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class HarvestCollection extends Resource
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
            'date' => $this->scheduled_at->toDateString(),
            'total' => (int) $this->quantity,
            'tx_id' => $this->xcp_core_tx_index,
        ];
    }
}
