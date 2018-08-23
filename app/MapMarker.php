<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MapMarker extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'farm_id',
        'latitude',
        'longitude',
        'settings',
        'major',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'settings' => 'array',
    ];
}