<?php

namespace App;

use Exception;
use App\Traits\Linkable;
use App\Traits\Touchable;
use App\Traits\Achievable;
use App\Events\TokenWasCreated;
use Gstt\Achievements\Achiever;
use Droplister\XcpCore\App\Asset;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use Achievable, Achiever, Linkable, Sluggable, SluggableScopeHelpers, Touchable;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TokenWasCreated::class,
    ];

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
        'slug',
        'image_url',
        'content',
        'meta_data',
        'meta_data->harvest_ranking',
        'meta_data->overall_ranking',
        'museumed_at',
        'approved_at',
        'rejected_at',
        'published_at',
        'created_at',
        'updated_at',
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
     * Set Content
     *
     * @param  string  $value
     * @return void
     */
    public function setContentAttribute($value)
    {
        $this->attributes['content'] = strip_tags($value);
    }

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
     * Farms
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function farms()
    {
        return $this->hasManyThrough(Farm::class, TokenBalance::class, 'asset', 'xcp_core_address', 'xcp_core_asset_name', 'address');
    }

    /**
     * Token Balances
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tokenBalances()
    {
        return $this->hasMany(TokenBalance::class, 'asset', 'xcp_core_asset_name')->nonZero();
    }

    /**
     * Not Divisible
     */
    public function scopeNotDivisible($query)
    {
        return $query->whereHas('asset', function ($asset) {
            return $asset->where('divisible', '=', 0);
        });
    }

    /**
     * Locked
     */
    public function scopeLocked($query)
    {
        return $query->whereHas('asset', function ($asset) {
            return $asset->where('locked', '=', 1);
        });
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
     * Pending
     */
    public function scopePending($query)
    {
        return $query->whereNull('approved_at')->whereNull('rejected_at');
    }

    /**
     * Publishable
     */
    public function scopePublishable($query)
    {
        return $query->notDivisible()->locked()->paidFor()->museumed()->pending();
    }

    /**
     * Published
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * Enforce Type Limit
     */
    public static function boot() {
        static::creating(function (Token $token) {
            if(in_array($token->type, ['access', 'reward']) && static::whereType($token->type)->exists()) {
                throw new Exception('Token Limit Exceeded');
            }
        });
        parent::boot();
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'method' => function ($string, $separator) {
                    return $string;
                }
            ]
        ];
    }
}
