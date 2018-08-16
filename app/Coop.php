<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coop extends Model
{
    use Sluggable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'farm_id',
        'name',
        'slug',
        'description',
        'image_url',
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
     * Admin
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
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
     * Harvests
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function harvests()
    {
        return $this->belongsToMany(Harvest::class, 'farm_harvest', 'coop_id', 'harvest_id')
            ->withPivot('quantity', 'dryasabone');
    }
}
