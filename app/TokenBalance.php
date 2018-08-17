<?php

namespace App;

use Droplister\XcpCore\App\Token;
use Droplister\XcpCore\App\Balance;
use Tightenco\Parental\HasParentModel;

class TokenBalance extends Balance
{
    use HasParentModel;

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->gameTokens();
        });
    }

    /**
     * Game Tokens
     */
    public function scopeGameTokens($query)
    {
        $assets = Token::pluck('xcp_core_asset_name');

        return $query->whereIn('asset', $assets);
    }
}