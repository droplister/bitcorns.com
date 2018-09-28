<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'xcp_core_tx_index',
        'featurable_id',
        'featurable_type',
        'address',
        'bid',
    ];

    /**
     * Get all of the owning uploadable models.
     */
    public function featurable()
    {
        return $this->morphTo();
    }

    /**
     * Highest Bids
     */
    public function scopeHighestBids($query)
    {
        return $query->where('xcp_core_tx_index', '>', config('bitcorn.feature_tx_index'))
            ->orderBy('bid', 'desc')
            ->orderBy('xcp_core_tx_index', 'desc');
    }
}