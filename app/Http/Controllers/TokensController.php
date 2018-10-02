<?php

namespace App\Http\Controllers;

use Cache;
use App\Token;
use Droplister\XcpCore\App\OrderMatch;
use App\Http\Requests\Cards\StoreRequest;
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
        $tokens = Token::published()
            ->tokens()
            ->oldest()
            ->get();

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
        if($token->type === 'upgrade')
        {
            return redirect(route('cards.show', ['card' => $token->slug]));
        }

        // Convenience
        $asset = $token->asset;
        $last_match = $token->lastMatch();

        // Get Farm Balances
        $balances = $token->balances()->has('farm')->with('farm')
            ->orderBy('quantity', 'desc')
            ->get();

        // Top Farm
        $top_farm = $token->balances()->has('farm')->with('farm')
            ->orderBy('quantity', 'desc')
            ->first()->farm;

        // Top Coop
        $top_coop = $token->balances()->has('farm')->with('farm')
            ->orderBy('quantity', 'desc')
            ->first()->farm;

        // Show View
        return view('tokens.show', compact('token', 'asset', 'balances', 'last_match', 'top_coop', 'top_farm'));
    }
}