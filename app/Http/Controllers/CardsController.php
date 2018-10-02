<?php

namespace App\Http\Controllers;

use Cache;
use App\Coop;
use App\Token;
use App\Harvest;
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

        // Cache Slug
        $cache_slug = str_slug(serialize($request->all()));

        // List Cards
        $cards = Cache::remember($cache_slug, 60, function () use ($request, $filter) {
            return Token::getFilteredCards($request, $filter)->get();
        });

        // Harvests
        $harvests = Cache::remember('harvests_completed', 60, function () {
            return Harvest::complete()->get();
        });

        // Index View
        return view('cards.index', compact('cards', 'filter', 'harvests'));
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

        // Convenience
        $asset = $card->asset;
        $last_match = $card->lastMatch();

        // Get Farm Balances
        $balances = Cache::remember('card_balances_' . $card->slug, 60, function () use ($card) {
            return $card->balances()->has('farm')->with('farm.coop')->orderBy('quantity', 'desc')->get();
        });

        // Top Coop
        $top_coop = Cache::remember('card_top_coop_' . $card->slug, 60, function () use ($card) {
            $unsorted = Coop::get();

            // Sorted
            $sorted = $unsorted->sortByDesc(function ($c) use ($card) {
                return $c->getBalance($card->xcp_core_asset_name);
            });

            return $sorted->first();
        });

        // Top Farm
        $top_farm = $balances->first()->farm;

        // Unlocked Achievements
        $unlocked_achievements = Cache::remember('card_u_achievements_' . $card->slug, 60, function () use ($card) {
            return $card->achievements()->with('details')->whereNotNull('unlocked_at')->oldest('unlocked_at')->get();
        });

        // Locked Achievements
        $locked_achievements = Cache::remember('card_l_achievements_' . $card->slug, 60, function () use ($card) {
            return $card->achievements()->with('details')->whereNull('unlocked_at')->oldest('unlocked_at')->get()
                ->sortByDesc(function ($achievement) {
                    return $achievement->points / $achievement->details->points;
                });
        });

        // Show View
        return view('cards.show', compact('card', 'asset', 'balances', 'last_match', 'top_coop', 'top_farm', 'unlocked_achievements', 'locked_achievements'));
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
        // DEX Average (All Cards)
        return Cache::remember('dex_average', 1440, function () {
            // Cards
            $card_assets = Token::published()->upgrades()->pluck('xcp_core_asset_name')->toArray();

            // Buys
            $buys = OrderMatch::whereIn('forward_asset', $card_assets)->where('backward_asset', '=', config('bitcorn.reward_token'));
            $average_buy = $buys->sum('forward_quantity') === 0 ? 0 : $buys->sum('backward_quantity') / $buys->sum('forward_quantity');

            // Sells
            $sells = OrderMatch::whereIn('backward_asset', $card_assets)->where('forward_asset', '=', config('bitcorn.reward_token'));
            $average_sell = $sells->sum('backward_asset') === 0 ? 0 : $sells->sum('forward_asset') / $sells->sum('backward_asset');

            // DEX Average
            return number_format(($average_buy + $average_sell) / 2);
        });
    }
}