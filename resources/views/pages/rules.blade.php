@extends('layouts.app')

@section('title', 'Game Rules')
@section('description', 'How to Play the Bitcorn Crops Game.')

@section('content')
<div class="container">
    <h1 class="display-4 mt-5 mb-5">
        Game Rules
    </h1>
    <div class="card mb-4">
        <div class="card-header">
            Overview
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4 col-lg-3">
                    <img src="{{ asset('/images/tiles/LAMBOGARAGE.png') }}" alt="LAMBOGARAGE" width="100%" />
                </div>
                <div class="col-sm-8 col-lg-9">
                    <p class="card-text">
                        The object of the <strong>BITCORN CROPS</strong> game is to become the wealthiest player through harvesting and collecting <a href="{{ route('tokens.show', ['token' => 'BITCORN']) }}">BITCORN</a>. The player who collects the most bitcorn at the end of the game wins. (See: <a href="#winning">Winning</a>.)
                    </p>
                    <p class="card-text">
                        By owning <a href="{{ route('tokens.show', ['token' => 'CROPS']) }}">CROPS</a>, players establish their Bitcoin addresses as <a href="{{ route('farms.index') }}">farms</a> on Bitcorns.com. With a farm, players can harvest crops for a bitcorn reward. (See: <a href="#harvests">Harvests</a>.)
                    </p>
                    <p class="card-text">
                        Between harvests, players can customize their farm's look, location, and in-game assets, immersing themselves in the <a href="#">Bitcorn world</a>. It's even possible to join forces! (See: <a href="#">Co-Ops</a>.)
                    </p>
                    <p class="card-text text-muted">
                        <em>If you have any questions, please <a href="mailto:bitcorncrops@gmail.com">contact us</a> or <a href="https://t.me/bitcorns" target="_blank">join our chat room</a>.</em>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            How to Play
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4 col-lg-3">
                    <img src="{{ asset('/images/tiles/HELIPAD.png') }}" alt="HELIPAD" width="100%" />
                </div>
                <div class="col-sm-8 col-lg-9">
                    <p class="card-text">
                        <strong>Bitcorns.com</strong> borrows elements of its game play from idle games, like <a href="https://www.hyperhippo.ca/adventure-capitalist" target="_blank">AdVenture Capitalist</a>, board games, like <a href="https://www.hasbro.com/en-us/brands/monopoly" target="_blank">Monopoly</a> and <a href="https://www.ubisoft.com/en-us/game/risk/" target="_blank">Risk</a>, and app games, like <a href="https://www.facebook.com/FarmVille/" target="_blank">Farmville</a>, and combines them on the blockchain using <a href="https://medium.com/@droplister/how-counterparty-xcp-works-a5d81256de5c" target="_blank">Counterparty</a>.
                    </p>
                    <p class="card-text">
                        To play, familiarize yourself with a Counterparty-enabled wallet, like <a href="https://wallet.counterwallet.io/" target="_blank">Counterwallet</a>, that you can use to access the blockchain and store your in-game assets. It's important that the wallet you choose can <a href="https://www.youtube.com/watch?v=Zne720b31Kk" target="_blank">sign messages</a>.
                    </p>
                    <p class="card-text">
                        Since, any Bitcoin address that has a non-zero balance of CROPS is considered a farm, players can establish their farm by purchasing crops <a href="{{ route('pages.buy') }}">here</a>. (See: <a href="#">Getting Started</a>.)
                    </p>
                    <p class="cart-text"> 
                        <a href="{{ config('bitcorn.counterwallet') }}" class="btn btn-sm btn-outline-primary" target="_blank">
                            <i class="fa fa-external-link-square"></i>
                            Counterwallet
                        </a>
                        <a href="{{ route('pages.buy') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-credit-card-alt"></i>
                            Buy CROPS
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            Getting Started
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4 col-lg-3">
                    <img src="{{ asset('/images/tiles/YACHTDOCK.png') }}" alt="YACHTDOCK" width="100%" />
                </div>
                <div class="col-sm-8 col-lg-9">
                    <p class="card-text">
                        It's possible to explore the <a href="#">map</a> and <a href="{{ route('farms.index') }}">visit farms</a> without being a player, but to get "on the board" takes owning CROPS. Crops are *the* access token for the <strong>Bitcorns.com</strong> game and the only way to establish a farm.
                    </p>
                    <p class="card-text">
                        Once established, farms show up on <a href="{{ route('farms.index', ['sort' => 'newest']) }}">this page</a>. Giving your farm a name or uploading farm art is a great way to get started. With the "Edit" button, you can make and save changes by <a href="https://www.youtube.com/watch?v=Zne720b31Kk" target="_blank">signing messages</a> using Counterwallet.
                    </p>
                    <p class="card-text">
                        You can get help learning Counterwallet and how to do message signing by joining our <a href="{{ config('bitcorn.telegram') }}" target="_blank">community chat room</a>. It's also a good place to meet other players and stay up to date on the latest game developments.
                    </p>
                    <p class="card-text text-muted">
                        <em>Additional resources can be found through our <a href="#">FAQ page</a>.</em>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            World Map
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4 col-lg-3">
                    <img src="{{ asset('/images/world-map.png') }}" alt="World Map" width="100%" />
                </div>
                <div class="col-sm-8 col-lg-9">
                    <p class="card-text">
                        On <strong>Bitcorns.com</strong>, the <a href="#">World Map</a> acts as the game board. Farms take up an amount of space proportional to the amount of CROPS they have. Once placed, no other farm can be placed in that same location.
                    </p>
                    <p class="card-text">
                        Players have used different strategies for placing their farms. Some make their farm's location related to their name and art, some choose the location they themselves live in, while other's choose exotic destinations.
                    </p>
                    <p class="card-text">
                        Where you place your farm is up to you and we intend to expand the role of the game board in the game as the community grows and the game progresses.
                    </p>
                    <p class="cart-text">
                        <a href="#" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-map-marker"></i>
                            World Map
                        </a>
                        <a href="{{ config('bitcorn.telegram') }}" class="btn btn-sm btn-outline-primary" target="_blank">
                            <i class="fa fa-telegram"></i>
                            Join Telegram
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <a name="harvests"></a>
    <div class="card mb-4">
        <div class="card-header">
            Harvests
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4 col-lg-3">
                    <img src="{{ asset('/images/tokens/BITCORN.png') }}" alt="BITCORN" width="100%" />
                </div>
                <div class="col-sm-8 col-lg-9">
                    <p class="card-text">
                        <strong>Bitcorn Farms</strong> harvest their CROPS every three months for a BITCORN reward. Over time, harvests will become less bountiful until no more bitcorn can grow. At that time, the game will end.
                    </p>
                    <p class="card-text">
                        Farms receive bitcorn during harvest times proportional to the size of their farm, as measured in crops, and according to the Farmer's Almanac, which forecasts bitcorn yield through January 2022.
                    </p>
                    <p class="card-text">
                        0.00003810 CROPS is the smallest a farm can be and still grow some bitcorn.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <a name="coops"></a>
    <div class="card mb-4">
        <div class="card-header">
            Co-Ops
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4 col-lg-3">
                    <img src="{{ asset('/images/tokens/SQUADGOALS.png') }}" alt="SQUADGOALS" width="100%" />
                </div>
                <div class="col-sm-8 col-lg-9">
                    <p class="card-text">
                        Cooperatives can be created by farmers with more than 0.1 CROPS. Cooperatives allow players to join forces and compete cooperatively for SQUADGOALS rather than the individual prize of BRAGGING.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <a name="winning"></a>
    <div class="card mb-4">
        <div class="card-header">
            Winning
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4 col-lg-3">
                    <img src="{{ asset('/images/tokens/BRAGGING.png') }}" alt="BRAGGING" width="100%" />
                </div>
                <div class="col-sm-8 col-lg-9">
                    <p class="card-text">
                        The <strong>Bitcorns.com</strong> game takes place on the blockchain, over the course of four years, ending in January 2022. On the day of the last harvest, <a href="{{ route('tokens.show', ['token' => 'BITCORN']) }}">BITCORN</a> balances will be snapshot and the winners announced.
                    </p>
                    <p class="card-text">
                        There are two paths to winning, players can win individually or as part of a <a href="{{ route('coops.index') }}">cooperative</a>. The individual winner is decided based on their bitcorn balance in January 2022. The Co-Op winner is decided based on group balances.
                    </p>
                    <p class="card-text">
                        The individual winner will receive ownership of the <a href="{{ route('tokens.show', ['token' => 'BRAGGING']) }}">BRAGGING</a> token, literally cryptographic bragging rights. Each player that's a part of the winning cooperative will receive 1 <a href="{{ route('tokens.show', ['token' => 'SQUADGOALS']) }}">SQUADGOALS</a>.
                    </p>
                    <p class="card-text text-muted">
                        <em>Read the <a href="{{ route('harvests.index') }}">Farmer's Almanac</a> to learn about harvesting.</em>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection