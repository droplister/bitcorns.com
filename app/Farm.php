<?php

namespace App;

use Gstt\Achievements\Achiever;
use Droplister\XcpCore\App\Credit;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use Achiever;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coop_id',
        'xcp_core_credit_id', 
        'name',
        'address',
        'description',
        'image_url',
        'total_harvested',
    ];


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
        return $this->belongsToMany(Harvest::class, 'farm_harvest', 'farm_id', 'harvest_id')
            ->withPivot('quantity', 'dryasabone');
    }
}