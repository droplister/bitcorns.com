<?php

namespace App;

use Droplister\XcpCore\App\Dividend;
use Droplister\XcpCore\App\Transaction;
use Illuminate\Database\Eloquent\Model;

class Harvest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'xcp_core_tx_index',
        'name',
        'content',
        'image_url',
        'quantity',
        'scheduled_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'scheduled_at',
    ];


    /**
     * Farms
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function farms()
    {
        return $this->belongsToMany(Farm::class, 'farm_harvest', 'harvest_id', 'farm_id')->withPivot('quantity');
    }

    /**
     * Dividend
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dividend()
    {
        return $this->belongsTo(Dividend::class, 'xcp_core_tx_index', 'tx_index');
    }

    /**
     * Transaction
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'xcp_core_tx_index', 'tx_index');
    }

    /**
     * Current
     */
    public function scopeCurrent($query)
    {
        return $query->whereNotNull('xcp_core_tx_index')->latest('scheduled_at');
    }

    /**
     * Upcoming
     */
    public function scopeUpcoming($query)
    {
        return $query->whereNull('xcp_core_tx_index')->oldest('scheduled_at');
    }
}
