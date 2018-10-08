<?php

namespace App;

use Cache;
use App\Events\FeatureWasCreated;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => FeatureWasCreated::class,
    ];

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
            ->orderBy('xcp_core_tx_index', 'desc')
            ->orderBy('bid', 'desc');
    }

    /**
     * Featured Cards
     */
    public static function featuredCards()
    {
        return Cache::remember('featured_cards', 60, function () {
            return static::where('featurable_type', '=', 'App\Token')
                ->with('featurable')
                ->highestBids()
                ->take(4)
                ->get();
        });
    }

    /**
     * Featured Farms
     */
    public static function featuredFarms()
    {
        return Cache::remember('featured_farms', 60, function () {
            return static::where('featurable_type', '=', 'App\Farm')
                ->with('featurable')
                ->highestBids()
                ->take(2)
                ->get();
        });
    }
}
