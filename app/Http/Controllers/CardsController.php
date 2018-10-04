<?php

namespace App\Http\Controllers;

use App\Token;
use App\Harvest;
use Illuminate\Http\Request;
use App\Http\Requests\Cards\IndexRequest;
use App\Http\Requests\Cards\StoreRequest;

class CardsController extends Controller
{
    /**
     * List Cards (Sortable)
     *
     * @param  \App\Http\Requests\Cards\IndexRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        // Set Filter
        $filter = $request->input('filter', null);

        // List Cards
        $cards = Token::getFilteredCards($request, $filter)->get();

        // Harvests
        $harvests = Harvest::complete()->get();

        // Index View
        return view('cards.index', compact('cards', 'filter', 'harvests'));
    }

    /**
     * Show Card
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Token  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Token $card)
    {
        // Token Redirect Guard
        if ($card->type !== 'upgrade') {
            return redirect(route('tokens.show', ['token' => $card->slug]));
        }

        // Show View
        return view('cards.show', compact('card'));
    }

    /**
     * Submit Card
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // DEX Average
        $dex_average = Token::getAverageCardPrice();

        // Queue Count
        $queue_count = Token::publishable()->upgrades()->count();

        // Create View
        return view('cards.create', compact('dex_average', 'queue_count'));
    }

    /**
     * Create Card
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
}
