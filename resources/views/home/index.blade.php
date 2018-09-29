@extends('layouts.app')

@section('title', 'Blockchain Farming Game')

@section('content')
<google-map v-bind:lat="39.828175" v-bind:lng="-98.5795" v-bind:zoom="2"></google-map>
<div class="container">
    <h1 class="display-4 my-5">
        How to Play
    </h1>
    <div class="card">
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
                        The object of the <strong>BITCORN CROPS</strong> game is to become the wealthiest player through harvesting and collecting <a href="{{ route('tokens.show', ['token' => 'BITCORN']) }}">BITCORN</a>. The player who collects the most bitcorn at the end of the game wins. (See: <a href="{{ route('pages.rules') }}#winning">Winning</a>.)
                    </p>
                    <p class="card-text">
                        By owning <a href="{{ route('tokens.show', ['token' => 'CROPS']) }}">CROPS</a>, players establish their Bitcoin addresses as <a href="{{ route('farms.index') }}">farms</a> on Bitcorns.com. With a farm, players can harvest crops for a bitcorn reward. (See: <a href="{{ route('harvests.index') }}">Harvests</a>.)
                    </p>
                    <p class="card-text">
                        Between harvests, players can customize their farm's look, location, and in-game assets, immersing themselves in the <a href="#">Bitcorn world</a>. It's even possible to join forces! (See: <a href="{{ route('coops.index') }}">Co-Ops</a>.)
                    </p>
                    <p class="cart-text">
                        <a href="{{ route('pages.rules') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i>
                            Full Rules
                        </a>
                        <a href="{{ config('bitcorn.telegram') }}" class="btn btn-sm btn-outline-primary" target="_blank">
                            <i class="fa fa-telegram"></i>
                            Telegram
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <h2 class="display-4 my-5">
        Bitcorn Farms
    </h2>
    <div class="row">
        @foreach($farms as $farm)
            <div class="col-12 col-sm-6 col-md-4 mb-5">
                @include('farms.partials.index.card', ['farm' => $farm->featurable])
            </div>
        @endforeach
        @if($field)
            <div class="col-12 col-sm-6 col-md-4 mb-5">
                @include('farms.partials.index.card', ['farm' => $field])
            </div>
        @endif
    </div>
    <h2 class="display-4 mb-5" style="white-space: nowrap;">
        <img src="{{ asset('/images/tokens/CROPS.png') }}" alt="CROPS access token" class="float-left mr-3" width="60" />
        Buy CROPS
        <small class="lead d-none d-sm-inline">
            Establish a Farm
        </small>
    </h2>
    <div class="card-deck mb-3 text-center">
        <div class="card mb-4 box-shadow">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Basic Access</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">$3.50</h1>
                <ul class="list-unstyled mt-3 mb-3">
                    <li>0.001 CROPS</li>
                </ul>
                <p class="card-text mb-4">
                    Receive an amount of CROPS sufficient to establish a Bitcorns.com farm and gain access to basic features, like updating farm names, locations, and descriptions.
                </p>
                <a href="{{ route('pages.buy') }}" class="btn btn-lg btn-block btn-primary">
                    <i class="fa fa-info-circle"></i>
                    More Info
                </a>
            </div>
        </div>
        <div class="card mb-4 box-shadow">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Upload Access</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">$29.99</h1>
                <ul class="list-unstyled mt-3 mb-3">
                    <li>0.01 CROPS</li>
                </ul>
                <p class="card-text mb-4">
                    Receive an amount of CROPS sufficient to establish a Bitcorns.com farm and gain access to basic features, in addition to the ability to upload custom farm art.
                </p>
                <a href="{{ route('pages.buy') }}" class="btn btn-lg btn-block btn-primary">
                    <i class="fa fa-info-circle"></i>
                    More Info
                </a>
            </div>
        </div>
        <div class="card mb-4 box-shadow">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">XCP DEX</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">{{ $last_price }}</h1>
                <ul class="list-unstyled mt-3 mb-3">
                    <li>1 CROPS</li>
                </ul>
                <p class="card-text mb-4">
                    Other amounts may be available on the Counterparty DEX or directly from other members of the community. The last trade on occurred at a strike price of {{ $last_price }}.
                </p>
                <a href="{{ config('bitcorn.xcpdex') }}" class="btn btn-lg btn-block btn-primary" target="_blank">
                    <i class="fa fa-info-circle"></i>
                    More Info
                </a>
            </div>
        </div>
    </div>
    <h2 class="display-4 mb-5">
        Bitcorn Cards
    </h2>
    <div class="row">
        @foreach($cards as $card)
            <div class="col-6 col-sm-4 col-lg-3 mb-4 text-center">
                @include('cards.partials.index.card', ['card' => $card->featurable, 'filter' => null])
            </div>
        @endforeach
    </div>
</div>
@endsection