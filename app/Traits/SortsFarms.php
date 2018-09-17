<?php

namespace App\Traits;

use App\Farm;
use App\Token;
use Exception;
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
                return Farm::hasAccess()->where('name', 'like', '%' . $request->q . '%')
                    ->orWhere('slug', 'like', '%' . $request->q . '%');
            case 'access':
                return Token::whereType('access')->first()->farms()->hasAccess()
                    ->orderBy('quantity', 'desc');
            case 'no-access':
                return Farm::doesntHaveAccess()
                    ->orderBy('created_at', 'desc');
            case 'reward':
                return Token::whereType('reward')->first()->farms()->hasAccess()
                    ->orderBy('quantity', 'desc');
            case 'rewards':
                return Farm::hasAccess()
                    ->orderBy('rewards_count', 'desc')
                    ->orderBy('created_at', 'asc');
            case 'rewards-total':
                return Farm::hasAccess()
                    ->orderBy('rewards_total', 'desc');
            case 'newest':
                return Farm::hasAccess()
                    ->orderBy('created_at', 'desc');
            case 'oldest':
                return Farm::hasAccess()
                    ->orderBy('created_at', 'asc');
            case 'updated':
                return Farm::hasAccess()
                    ->orderBy('updated_at', 'desc');
            default:
                Exception('Sort Validation Failure');
        }
    }
}