<?php

namespace App;

use Gstt\Achievements\Achiever;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use Achiever, Sluggable;
}
