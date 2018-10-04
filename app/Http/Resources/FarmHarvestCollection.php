<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class FarmHarvestCollection extends Resource
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
            'total' => (int) ($this->pivot->quantity * $this->pivot->multiplier),
            'tx_id' => $this->xcp_core_tx_index,
        ];
    }
}
