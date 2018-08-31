<?php

namespace App;

use App\Traits\Mappable;
use Illuminate\Database\Eloquent\Model;

class MapMarker extends Model
{
    use Mappable;

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
        return $this->belongsTo(Farm::class, 'address', 'xcp_core_address')->hasAccess();
    }
}