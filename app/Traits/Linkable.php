<?php

namespace App\Traits;

trait Linkable
{
    /**
     * URL
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        $table = $this->getTable();
        $route = "{$table}.show";
        $slug = str_singular($table);

        return route($route, [$slug => $this->slug]);
    }
}
