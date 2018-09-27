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
     * Owner
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(Farm::class, 'farm_id', 'id');
    }

    /**
     * Farms
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function farms()
    {
        return $this->hasMany(Farm::class, 'coop_id', 'id');
    }

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
        return $this->hasManyThrough(TokenBalance::class, Farm::class, 'coop_id', 'address', 'id', 'xcp_core_address')->tokens()->with('token');
    }

    /**
     * Upgrade Balances
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function upgradeBalances()
    {
        return $this->hasManyThrough(TokenBalance::class, Farm::class, 'coop_id', 'address', 'id', 'xcp_core_address')->upgrades()->nonZero()->with('token');
    }

    /**
     * Harvests
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function harvests()
    {
        return $this->belongsToMany(Harvest::class, 'farm_harvest', 'coop_id', 'harvest_id')->withPivot('quantity', 'multiplier');
    }

    /**
     * Uploads
     */
    public function uploads()
    {
        return $this->morphMany(Upload::class, 'uploadable');
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
