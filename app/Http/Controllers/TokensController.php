<?php

namespace App\Http\Controllers;

use Cache;
use App\Token;
use App\Harvest;
use Illuminate\Http\Request;

class TokensController extends Controller
{
    /**
     * List Tokens
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get Tokens
        $tokens = Cache::remember('tokens_index', 60, function () {
            return Token::published()->tokens()->oldest()->get();
        });

        // Index View
        return view('tokens.index', compact('tokens'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Token  $token
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Token $token)
    {
        // Card Redirect Guard
        if ($token->type === 'upgrade') {
            return redirect(route('cards.show', ['card' => $token->slug]));
        }

        // Farm Token Balances
        $balances = Cache::remember('tokens_show_balances_' . $token->id, 60, function () use ($token) {
            return $token->farmBalances->sortByDesc(function ($balance) use ($token) {
                if($token->name === config('bitcorn.reward_token') && $balance->address === config('bitcorn.genesis_address')) {
                    return $balance->quantity - Harvest::upcoming()->sum('quantity');
                }else{
                    return $balance->quantity;
                }
            });
        });

        // Show View
        return view('tokens.show', compact('token', 'balances'));
    }
}
