<?php

namespace App\Http\Controllers\Api;

use App\Token;
use App\Http\Resources\TokenResource;
use App\Http\Resources\TokenCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $tokens = Token::published()->get();

        return TokenCollection::collection($tokens);
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
        return new TokenResource($token);
    }
}
