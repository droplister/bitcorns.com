<?php

namespace App;

use App\Traits\Linkable;
use App\Traits\Achievable;
use Gstt\Achievements\Achiever;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coop extends Model
{
    use Achievable, Achiever, Linkable, Sluggable, SluggableScopeHelpers, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'farm_id',
        'name',
        'slug',
        'image_url',
        'content',
        'total_harvested',
        'deleted_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * Balances
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function balances()
    {
        return $this->hasManyThrough(TokenBalance::class, Farm::class, 'coop_id', 'address', 'id', 'xcp_core_address')->with('token');
    }

    /**
     * Token Balances
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tokenBalances()
    {
        return $this->hasManyThrough(TokenBalance::class, Farm::class, 'coop_id', 'address', 'id', 'xcp_core_address')->published()->tokens()->with('token');
    }

    /**
     * Upgrade Balances
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function upgradeBalances()
    {
        return $this->hasManyThrough(TokenBalance::class, Farm::class, 'coop_id', 'address', 'id', 'xcp_core_address')->published()->upgrades()->nonZero()->with('token');
    }

    /**
     * Farms
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function farms()
    {
        return $this->hasMany(Farm::class, 'coop_id', 'id')->hasAccess();
    }

    /**
     * Features
     */
    public function features()
    {
        return $this->morphMany(Feature::class, 'featurable');
    }

    /**
     * Harvests
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function harvests()
    {
        return $this->belongsToMany(Harvest::class, 'farm_harvest', 'coop_id', 'harvest_id')->withPivot('farm_id', 'quantity', 'multiplier');
    }

    /**
     * Owner
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(Farm::class, 'farm_id', 'id');
    }

    /**
     * Uploads
     */
    public function uploads()
    {
        return $this->morphMany(Upload::class, 'uploadable');
    }

    /**
     * Access Balance
     *
     * @return \App\Balance
     */
    public function accessBalance()
    {
        return $this->getBalance(config('bitcorn.access_token'));
    }

    /**
     * Reward Balance
     *
     * @return \App\Balance
     */
    public function rewardBalance()
    {
        return $this->getBalance(config('bitcorn.reward_token'));
    }

    /**
     * Get Balance
     *
     * @param string  $asset
     * @var string
     */
    public function getBalance($asset)
    {
        return $this->balances()->where('asset', '=', $asset)->get()->sum(function ($balance) {
            return $balance->quantity_normalized;
        });
    }

    /**
     * Harvest Farms
     *
     * @param \App\Harvest  $harvest
     * @var string
     */
    public function harvestFarms($harvest)
    {
        return $this->harvests()->where('harvest_id', '=', $harvest->id)->count();
    }

    /**
     * Harvest Total
     *
     * @param \App\Harvest  $harvest
     * @param boolean  $multiply
     * @var string
     */
    public function harvestTotal($harvest, $multiply = false)
    {
        return $this->harvests()->where('harvest_id', '=', $harvest->id)->get()->sum(function ($harvest) use ($multiply) {
            if ($multiply) {
                return $harvest->pivot->quantity * $harvest->pivot->multiplier;
            }

            return $harvest->pivot->quantity;
        });
    }

    /**
     * Coop Total
     *
     * @param boolean  $multiply
     * @var string
     */
    public function coopTotal($multiply = false)
    {
        return $this->harvests()->whereNotNull('xcp_core_tx_index')->get()->sum(function ($harvest) use ($multiply) {
            if ($multiply) {
                return $harvest->pivot->quantity * $harvest->pivot->multiplier;
            }

            return $harvest->pivot->quantity;
        });
    }

    /**
     * Alpha Collectors
     *
     * @return boolean
     */
    public function isAC()
    {
        $top_coop = Coop::withCount('upgradeBalances')
            ->orderBy('upgrade_balances_count', 'desc')
            ->first();

        return $this->id === $top_coop->id;
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
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
                'source' => 'name'
            ]
        ];
    }
}
