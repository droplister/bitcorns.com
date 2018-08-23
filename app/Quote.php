<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author',
        'quote',
    ];

    /**
     * The attributes that are appended.
     *
     * @var array
     */
    protected $appends = [
        'formatted',
    ];

    /**
     * Formatted
     *
     * @return string
     */
    public function getFormattedAttribute()
    {
        return '"' . $this->quote .'" - ' . $this->author;
    }
}