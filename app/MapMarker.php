<?php

namespace App;

use App\Traits\Mappable;
use App\Events\MapMarkerWasCreated;
use Illuminate\Database\Eloquent\Model;

class MapMarker extends Model
{
    use Mappable;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => MapMarkerWasCreated::class,
    ];

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

    /**
     * Farm
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    /**
     * Major
     */
    public function scopeMajor($query)
    {
        return $query->where('major', '=', 1);
    }

    /**
     * Minor
     */
    public function scopeMinor($query)
    {
        return $query->where('minor', '=', 0);
    }
}