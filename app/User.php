<?php

namespace App;

use Throwable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
     * One Admin Account
     */
    public static function boot() {
        static::creating(function () {
            if(static::count() > 0) throw new Throwable('User Limit Exceeded');
        });
        parent::boot();
    }
}
