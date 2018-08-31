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
        return $this->belongsTo(Token::class, 'asset_name', 'xcp_core_asset_name');
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
        return $query->whereHas('token', function($token) {
            return $token->where('type', '=', 'access')->orWhere('type', '=', 'reward');
        });
    }

    /**
     * Scope Upgrades
     */
    public function scopeUpgrades($query)
    {
        return $query->whereHas('token', function($token) {
            return $token->where('type', '=', 'upgrade')->published();
        });
    }

    /**
     * Game Players
     */
    public function scopeGamePlayers($query, $access_required=true)
    {
        $farms = Farm::query();

        if($access_required) $farms = $farms->hasAccess();

        $farms = $farms->pluck('xcp_core_address');

        return $query->whereIn('address', $farms);
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