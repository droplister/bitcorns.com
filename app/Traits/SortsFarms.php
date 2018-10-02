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
                return static::hasAccess()
                    ->where('name', 'like', '%' . $request->q . '%')
                    ->orWhere('slug', 'like', '%' . $request->q . '%');
            case 'cards':
                return static::hasAccess()
                    ->withCount('upgradeBalances')
                    ->orderBy('upgrade_balances_count', 'desc');
            case 'bitcorn':
                return Token::whereType('reward')->first()->farms()->hasAccess()
                    ->orderBy('quantity', 'desc');
            case 'crops':
                return Token::whereType('access')->first()->farms()->hasAccess()
                    ->orderBy('quantity', 'desc');
            case 'no-crops':
                return static::doesntHaveAccess()
                    ->orderBy('created_at', 'desc');
            case 'harvests':
                return static::hasAccess()
                    ->withCount('harvests')
                    ->orderBy('harvests_count', 'desc')
                    ->orderBy('created_at', 'asc');
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