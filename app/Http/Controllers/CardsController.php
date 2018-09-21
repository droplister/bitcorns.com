<?php

namespace App\Http\Controllers;

use Cache;
use App\Token;
use Droplister\XcpCore\App\OrderMatch;
use App\Http\Requests\Cards\IndexRequest;
use App\Http\Requests\Cards\StoreRequest;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\Cards\IndexRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        // Get Filter
        $filter = $request->input('filter', null);

        // List Farms
        $cards = Token::getFilteredCards($request, $filter)->get();

        // Index View
        return view('cards.index', compact('cards', 'filter'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Token  $card
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
        $balances = $card->balances()->with('farm')
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
        // DEX Average
        $dex_average = $this->getAverageDexPrice();

        // Queue Count
        $queue_count = Token::publishable()->upgrades()->count();

        // Create View
        return view('cards.create', compact('dex_average', 'queue_count'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Cards\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        // Create Card
        $card = Token::createCard($request);

        // Report Back
        return redirect(route('cards.create'))->with('success', 'Success - Card Submitted!');
    }

    /**
     * Get Average DEX Price
     * 
     * @return string
     */
    private function getAverageDexPrice()
    {
        // DEX Average
        return Cache::remember('dex_average', 1440, function () {
            // Cards
            $card_assets = Token::published()->upgrades()
                ->pluck('xcp_core_asset_name')
                ->toArray();

            // Buys
            $buys = OrderMatch::whereIn('forward_asset', $card_assets)
                ->where('backward_asset', '=', config('bitcorn.reward_token'));
            $average_buy = $buys->sum('forward_quantity') === 0 ? 0 : $buys->sum('backward_quantity') / $buys->sum('forward_quantity');

            // Sells
            $sells = OrderMatch::whereIn('backward_asset', $card_assets)
                ->where('forward_asset', '=', config('bitcorn.reward_token'));
            $average_sell = $sells->sum('backward_asset') === 0 ? 0 : $sells->sum('forward_asset') / $sells->sum('backward_asset');

            // DEX Average
            return number_format(($average_buy + $average_sell) / 2);
        });
    }
}