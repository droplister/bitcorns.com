<?php

namespace App;

use Throwable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Enforce User Limit
     */
    public static function boot() {
        static::creating(function () {
            if(static::count() > 0) throw new Throwable('User Limit Exceeded');
        });
        parent::boot();
    }
}
