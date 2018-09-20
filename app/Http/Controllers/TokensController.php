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

        // Get Farm Balances
        $balances = $token->tokenBalances()->with('farm')
            ->orderBy('quantity', 'desc')
            ->paginate(20);

        // Show View
        return view('tokens.show', compact('token', 'balances'));
    }
}