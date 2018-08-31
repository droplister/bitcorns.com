<?php

namespace App\Http\Controllers;

use App\Token;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cards = Token::published()->
            ->whereType('upgrade')
            ->oldest()
            ->get();

        return view('cards.index', compact('cards'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Token  $token
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Token $token)
    {
        // Token Redirect Guard
        if($token->type !== 'upgrade')
        {
            return redirect(route('tokens.show', ['token' => $token->name]));
        }

        // Reassign
        $card = $token;

        // Balances
        $balances = $card->tokenBalances()->with('farm')
            ->orderBy('quantity', 'desc')
            ->paginate(20);

        return view('cards.show', compact('card', 'balances'));
    }
}