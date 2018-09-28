<?php

namespace App;

use App\Coop;
use App\Token;
use App\Harvest;
use App\Traits\Linkable;
use App\Traits\Signable;
use App\Traits\Achievable;
use App\Traits\SortsFarms;
use App\Events\FarmWasCreated;
use Gstt\Achievements\Achiever;
use Droplister\XcpCore\App\Credit;
use Droplister\XcpCore\App\Address;
use Droplister\XcpCore\App\Transaction;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use Achievable, Achiever, Linkable, Signable, Sluggable, SluggableScopeHelpers, SortsFarms;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => FarmWasCreated::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'xcp_core_address',
        'xcp_core_credit_id', 
        'coop_id',
        'name',
        'slug',
        'image_url',
        'content',
        'total_harvested',
        'access',
    ];

    /**
     * Display Name
     *
     * @var string
     */
    public function getDisplayNameAttribute()
    {
        return $this->accessBalance()->quantity > 0 ? $this->name : 'NO CROPPER';
    }

    /**
     * Display Image URL
     *
     * @var string
     */
    public function getDisplayImageUrlAttribute()
    {
        return $this->accessBalance()->quantity > 0 ? $this->image_url : '/images/default/0.jpg';
    }

    /**
     * Map Radius
     *
     * @var string
     */
    public function getMapRadiusAttribute()
    {
        // Zero is Zero
        if(! $this->access === 0) return 0;

        // 0.00003810 CROPS = 1 Arce
        $acres = $this->accessBalance()->quantity_normalized / 0.00003810;

        // Area Formula (using meters squared)
        $area = $meters_squared = $acres * 4046.85642;

        // Radius Formula
        $radius = sqrt($area / pi());

        // 10x Multiplier
        return $radius * 10;
    }

    /**
     * Address
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class, 'xcp_core_address', 'address');
    }

    /**
     * Balances
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function balances()
    {
        return $this->hasMany(TokenBalance::class, 'address', 'xcp_core_address');
    }

    /**
     * Token Balances
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tokenBalances()
    {
        return $this->hasMany(TokenBalance::class, 'address', 'xcp_core_address')->tokens();
    }

    /**
     * Upgrade Balances
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function upgradeBalances()
    {
        return $this->hasMany(TokenBalance::class, 'address', 'xcp_core_address')->upgrades()->nonZero();
    }

    /**
     * Coop
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coop()
    {
        return $this->belongsTo(Coop::class, 'coop_id', 'id');
    }

    /**
     * First CROPS (Credit Event)
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function firstCrops()
    {
        return $this->belongsTo(Credit::class, 'xcp_core_credit_id', 'id');
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
        return $this->belongsToMany(Harvest::class, 'farm_harvest', 'farm_id', 'harvest_id')->withPivot('coop_id', 'quantity', 'multiplier');
    }

    /**
     * Map Markers
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mapMarkers()
    {
        return $this->hasMany(MapMarker::class, 'id', 'farm_id');
    }

    /**
     * Transactions
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'source', 'xcp_core_address');
    }

    /**
     * Uploads
     */
    public function uploads()
    {
        return $this->morphMany(Upload::class, 'uploadable');
    }

    /**
     * Has Access
     */
    public function scopeHasAccess($query)
    {
        return $query->where('access', '=', 1);
    }

    /**
     * Has Access
     */
    public function scopeDoesntHaveAccess($query)
    {
        return $query->where('access', '=', 0);
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
     * @return \App\Balance
     */
    public function getBalance($asset_name)
    {
        return $this->balances()
            ->where('asset', '=', $asset_name)
            ->first();
    }

    /**
     * Has Balance
     *
     * @return \App\TokenBalance
     */
    public function hasBalance($asset_name)
    {
        return $this->balances()
            ->where('asset', '=', $asset_name)
            ->where('quantity', '>', 0)
            ->exists();
    }

    /**
     * Harvest Coop
     *
     * @param \App\Harvest  $harvest
     * @return boolean
     */
    public function harvestCoop(Harvest $harvest)
    {
        $result = $this->harvests()->where('harvest_id', '=', $harvest->id)->first();

        return Coop::find($result->pivot->coop_id);
    }

    /**
     * Is DAAB
     *
     * @return boolean
     */
    public function isDAAB()
    {
        // DAAB Token
        $token = Token::where('xcp_core_asset_name', '=', config('bitcorn.daab_token'))->first();

        // Balances (hi -> lo)
        $token_balances = $token->balances()->has('farm')->with('farm')->orderBy('quantity', 'desc')->get();

        // Check Whether DAAB
        foreach($token_balances as $token_balance)
        {
            // Forever Moist!
            if($token_balance->farm->hasBalance(config('bitcorn.daab_save_token'))) continue;

            // Dry as a Bone!
            return $token_balance->farm->id === $this->id;
        }

        // Nope
        return false;
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
                'source' => 'xcp_core_address',
                'method' => function ($string, $separator) {
                    return $string;
                }
            ]
        ];
    }
}