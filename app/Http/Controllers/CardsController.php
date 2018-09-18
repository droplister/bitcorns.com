<?php

namespace App\Http\Controllers;

use Storage;
use App\Token;
use App\Http\Requests\Cards\StoreRequest;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get Cards
        $cards = Token::published()
            ->whereType('upgrade')
            ->oldest()
            ->get();

        // Index View
        return view('cards.index', compact('cards'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Token  $token
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Token $card)
    {
        // Token Redirect Guard
        if($card->type !== 'upgrade')
        {
            return redirect(route('tokens.show', ['token' => $card->slug]));
        }

        // Get Farm Balances
        $balances = $card->tokenBalances()->with('farm')
            ->orderBy('quantity', 'desc')
            ->paginate(20);

        // Show View
        return view('cards.show', compact('card', 'balances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Create View
        return view('cards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Cards\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        // Save Image(s)
        $image_url = $this->storeImage($request->image);

        // HD Optional
        if($request->has('hd_image'))
        {
            $hd_image_url = $this->storeImage($request->hd_image);
        }

        // Create Card
        $card = Token::create([
            'xcp_core_asset_name' => $request->name,
            'xcp_core_burn_tx_hash' => $request->burn,
            'type' => 'upgrade',
            'name' => $request->name,
            'image_url' => $image_url,
            'content' => $request->content,
        ]);

        // Update Meta
        if(isset($hd_image_url))
        {
            $card->update(['meta_data->hd_image_url' => $hd_image_url]);
        }

        // Report Back
        return redirect(route('cards.create'))->with('success', 'Success - Card Submitted!');
    }

    /**
     * Store Image
     * 
     * @param  string  $file
     * @return string
     */
    private function storeImage($file)
    {
        // Put File
        $image_path = Storage::putFile('public/tokens/', $file);

        // Relative
        $image_url = Storage::url($image_path);

        // Absolute
        return url($image_url);
    }
}