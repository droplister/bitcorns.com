<?php

namespace App\Http\Controllers;

use Cache;
use App\Token;
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

        // Show View
        return view('tokens.show', compact('token'));
    }
}
