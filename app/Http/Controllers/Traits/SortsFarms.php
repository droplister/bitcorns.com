<?php

namespace App\Http\Controllers\Traits;

use App\Farm;
use App\Token;
use Throwable;

trait SortsFarms
{
    /**
     * Get Sorted Farms
     *
     * @param  \Illuminate\Http\Request  $request
     */
    private function getSortedFarms(Request $request)
    {
        // Search
        if($request->has('q'))
        {
             return Farm::hasAccess()->where('name', 'like', '%' . $request->q . '%')
                 ->orWhere('slug', 'like', '%' . $request->q . '%');
        }

        // Sort Order
        $sort = $request->input('sort', 'access'); // default = 'access'

        // Sorted
        switch($sort)
        {
            case 'access':
                $token = Token::whereType('access')->first();
                return $token->farms()->hasAccess()
                    ->orderBy('quantity', 'desc');
            case 'reward':
                $token = Token::whereType('reward')->first();
                return $token->farms()->hasAccess()
                    ->orderBy('quantity', 'desc');
            case 'rewards':
                return Farm::hasAccess()
                    ->orderBy('rewards_count', 'desc')
                    ->orderBy('created_at', 'asc');
            case 'rewards-total':
                return Farm::hasAccess()
                    ->orderBy('rewards_total', 'desc');
            case 'no-access':
                return Farm::doesntHaveAccess()
                    ->orderBy('created_at', 'desc');
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
                Throwable('Sort Validation Failure');
        }
    }
}