<?php

namespace App;

use Throwable;
use App\Traits\Achievable;
use App\Traits\Touchable;
use Gstt\Achievements\Achiever;
use Droplister\XcpCore\App\Asset;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use Achievable, Achiever, Touchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'xcp_core_asset_name',
        'xcp_core_burn_tx_hash',
        'harvest_id',
        'type',
        'name',
        'image_url',
        'content',
        'meta_data',
        'meta_data->harvest_ranking',
        'meta_data->overall_ranking',
        'museumed_at',
        'approved_at',
        'rejected_at',
        'published_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta_data' => 'array',
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
        'published_at',
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
     * Token Balances
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tokenBalances()
    {
        return $this->hasMany(TokenBalance::class, 'asset', 'xcp_core_asset_name');
    }

    /**
     * Paid For
     */
    public function scopePaidFor($query)
    {
        return $query->whereNotNull('xcp_core_burn_tx_hash');
    }

    /**
     * Museumed
     */
    public function scopeMuseumed($query)
    {
        return $query->whereNotNull('museumed_at');
    }

    /**
     * Approved
     */
    public function scopeApproved($query)
    {
        return $query->whereNotNull('approved_at')->whereNull('rejected_at');
    }

    /**
     * Rejected
     */
    public function scopeRejected($query)
    {
        return $query->whereNotNull('rejected_at');
    }

    /**
     * Publishable
     */
    public function scopePublishable($query)
    {
        return $query->paidFor()->museumed()->approved();
    }

    /**
     * Published
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    /**
     * Enforce Type Limit
     */
    public static function boot() {
        static::creating(function (Token $token) {
            if(in_array($token->type, ['access', 'reward']) && static::whereType($token->type)->exists()) {
                throw new Throwable('Token Limit Exceeded');
            }
        });
        parent::boot();
    }
}
