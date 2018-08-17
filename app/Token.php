<?php

namespace App;

use Gstt\Achievements\Achiever;
use Droplister\XcpCore\App\Asset;
use Droplister\XcpCore\App\Balance;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use Achiever;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'xcp_core_asset_name',
        'xcp_core_burn_tx_hash',
        'type',
        'name',
        'image_url',
        'content',
        'museumed_at',
        'approved_at',
        'rejected_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'museumed_at',
        'approved_at',
        'rejected_at',
    ];

    /**
     * Asset
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'xcp_core_asset_name', 'asset_name');
    }

    /**
     * Balances
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function balances()
    {
        return $this->hasMany(Balance::class, 'asset', 'xcp_core_asset_name');
    }
}
