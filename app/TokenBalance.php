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
            $query->gamePlayers()->gameTokens();
        });
    }

    /**
     * Farm
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function farm()
    {
        return $this->belongsTo(Farm::class, 'address', 'xcp_core_address')->hasAccess();
    }

    /**
     * Token
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function token()
    {
        return $this->belongsTo(Token::class, 'asset', 'xcp_core_asset_name');
    }

    /**
     * Published
     */
    public function scopePublished($query)
    {
        return $query->whereHas('token', function ($token) {
            return $token->whereNotNull('published_at');
        });
    }

    /**
     * Non Zero
     */
    public function scopeNonZero($query)
    {
        return $query->where('quantity', '>', 0);
    }

    /**
     * Scope Tokens
     */
    public function scopeTokens($query)
    {
        $tokens = Token::tokens()->pluck('xcp_core_asset_name');

        return $query->whereIn('asset', $tokens);
    }

    /**
     * Scope Upgrades
     */
    public function scopeUpgrades($query)
    {
        $tokens = Token::upgrades()->pluck('xcp_core_asset_name');

        return $query->whereIn('asset', $tokens);
    }

    /**
     * Game Players
     */
    public function scopeGamePlayers($query)
    {
        $farms = Farm::pluck('xcp_core_address');

        return $query->whereIn('address', $farms);
    }

    /**
     * Game Tokens
     */
    public function scopeGameTokens($query)
    {
        $tokens = Token::pluck('xcp_core_asset_name');

        return $query->whereIn('asset', $tokens);
    }
}