<?php

namespace App\Http\Controllers;

use Cache;
use App\Coop;
use App\Token;
use Illuminate\Http\Request;

class TokensController extends Controller
{
    /**
     * Display a listing of the resource.
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

        // Convenience
        $asset = $token->asset;
        $last_match = $token->lastMatch('XCP');

        // Get Farm Balances
        $balances = Cache::remember('token_balances_' . $token->slug, 60, function () use ($token) {
            return $token->balances()->has('farm')->with('farm.coop')->orderBy('quantity', 'desc')->get();
        });

        // Top Coop
        $top_coop = Cache::remember('token_top_coop_' . $token->slug, 60, function () use ($token) {
            $unsorted = Coop::get();

            // Sorted
            $sorted = $unsorted->sortByDesc(function ($c) use ($token) {
                return $c->getBalance($token->xcp_core_asset_name);
            });

            return $sorted->first();
        });

        // Top Farm
        $top_farm = $balances->first()->farm;

        // Unlocked Achievements
        $unlocked_achievements = Cache::remember('token_u_achievements_' . $token->slug, 60, function () use ($token) {
            return $token->achievements()->with('details')->whereNotNull('unlocked_at')->oldest('unlocked_at')->get();
        });

        // Locked Achievements
        $locked_achievements = Cache::remember('token_l_achievements_' . $token->slug, 60, function () use ($token) {
            return $token->achievements()->with('details')->whereNull('unlocked_at')->oldest('unlocked_at')->get()
                ->sortByDesc(function ($achievement) {
                    return $achievement->points / $achievement->details->points;
                });
        });

        // Show View
        return view('tokens.show', compact('token', 'asset', 'balances', 'last_match', 'top_coop', 'top_farm', 'unlocked_achievements', 'locked_achievements'));
    }
}
