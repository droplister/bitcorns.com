<?php

namespace App\Traits;

use Exception;
use App\Token;
use App\Http\Requests\Farms\IndexRequest;

trait SortsFarms
{
    /**
     * Get Sorted Farms
     *
     * @param  \App\Http\Requests\Farms\IndexRequest  $request
     * @param  string  $sort
     * @return mixed
     */
    public static function getSortedFarms(IndexRequest $request, $sort)
    {
        switch($sort)
        {
            case 'search':
                return static::hasAccess()->where('name', 'like', '%' . $request->q . '%')
                    ->orWhere('slug', 'like', '%' . $request->q . '%');
            case 'access':
                return Token::whereType('access')->first()->farms()->hasAccess()
                    ->orderBy('quantity', 'desc');
            case 'no-access':
                return static::doesntHaveAccess()
                    ->orderBy('created_at', 'desc');
            case 'reward':
                return Token::whereType('reward')->first()->farms()->hasAccess()
                    ->orderBy('quantity', 'desc');
            case 'rewards':
                return static::hasAccess()
                    ->orderBy('rewards_count', 'desc')
                    ->orderBy('created_at', 'asc');
            case 'rewards-total':
                return static::hasAccess()
                    ->orderBy('rewards_total', 'desc');
            case 'newest':
                return static::hasAccess()
                    ->orderBy('created_at', 'desc');
            case 'oldest':
                return static::hasAccess()
                    ->orderBy('created_at', 'asc');
            case 'updated':
                return static::hasAccess()
                    ->orderBy('updated_at', 'desc');
            default:
                Exception('Sort Validation Failure');
        }
    }
}