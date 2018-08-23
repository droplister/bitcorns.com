<?php

namespace App\Http\Controllers;

use App\Token;
use App\Harvest;
use App\Http\Requests\Tokens\StoreRequest;
use Illuminate\Http\Request;

class TokensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Card Index
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Submission Form
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Tokens\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        // Store the image
        $image_path = Storage::putFile('public/tokens/', $request->image);
        $image_url = Storage::url($image_path);

        Token::create([
            'xcp_core_asset_name' => $request->name,
            'xcp_core_burn_tx_hash' => $request->burn,
            'type' => 'upgrade',
            'name' => $request->name,
            'image_url' => $image_url,
            'content' => $request->content,
        ]);

        return redirect(route('tokens.create'))->with('success', 'Success - Card Submitted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Approve / Deny
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Approve / Deny
    }
}