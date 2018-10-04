<?php

namespace App\Http\Controllers\Api;

use App\Coop;
use App\Farm;
use App\Token;
use App\Harvest;
use App\MapMarker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InfoController extends Controller
{
    /**
     * Game Info
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'total_cards' => Token::published()->upgrades()->count(),
            'total_groups' => Coop::count(),
            'total_places' => MapMarker::count(),
            'total_players' => Farm::hasAccess()->count(),
            'total_rewards' => Harvest::upcoming()->sum('quantity'),
        ];
    }
}
