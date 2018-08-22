<?php

namespace App;

use App\Traits\Achievable;
use Gstt\Achievements\Achiever;
use Droplister\XcpCore\App\Credit;
use Droplister\XcpCore\App\Address;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use Achievable, Achiever, Sluggable;

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
     * Address
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class, 'xcp_core_address', 'address');
    }

    /**
     * Token Balances
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tokenBalances()
    {
        return $this->hasMany(TokenBalance::class, 'address', 'xcp_core_address');
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
     * Harvests
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function harvests()
    {
        return $this->belongsToMany(Harvest::class, 'farm_harvest', 'farm_id', 'harvest_id')->withPivot('quantity');
    }

    /**
     * Has Balance
     *
     * @return \App\TokenBalance
     */
    public function hasBalance($asset_name)
    {
        return $this->tokenBalances()->where('asset', '=', $asset_name)->where('quantity', '>', 0)->exists();
    }

    /**
     * Is DAAB
     *
     * @return boolean
     */
    public function isDAAB()
    {
        $token = Token::where('xcp_core_asset_name', '=', config('bitcorn.daab_token'))->first();

        $token_balances = $token->tokenBalances()->with('farms')->orderBy('quantity', 'desc')->get();

        foreach($token_balances as $token_balance)
        {
            if($token_balance->farm->hasBalance(config('bitcorn.daab_save_token'))) continue;

            return $token_balance->farm->id === $this->id;
        }

        return false;
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