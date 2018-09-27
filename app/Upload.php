<?php

namespace App;

use App\Events\UploadWasCreated;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => UploadWasCreated::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uploadable_id',
        'uploadable_type',
        'new_image_url',
        'old_image_url',
        'approved_at',
        'rejected_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'approved_at',
        'rejected_at',
    ];

    /**
     * Get all of the owning uploadable models.
     */
    public function uploadable()
    {
        return $this->morphTo();
    }
}
