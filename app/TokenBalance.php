<?php

namespace App;

use App\Token;
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
     * Token
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function token()
    {
        return $this->belongsTo(Token::class, 'asset_name', 'xcp_core_asset_name');
    }

    /**
     * Game Tokens
     */
    public function scopeGameTokens($query, $type=null)
    {
        $tokens = Token::query();

        if($type) $tokens = $tokens->where('type', '=', $type);

        $tokens = $tokens->pluck('xcp_core_asset_name');

        return $query->whereIn('asset', $tokens);
    }
}