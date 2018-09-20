@extends('layouts.app')

@section('title', 'Blockchain Farming Game')

@section('content')
<div class="container">
    <h2 class="display-4 my-5" style="white-space: nowrap;">
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
                <h1 class="card-title pricing-card-title">$6.99</h1>
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
                <h1 class="card-title pricing-card-title">$69</h1>
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
                <h4 class="my-0 font-weight-normal">Co-Op Access</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">Sold Out</h1>
                <ul class="list-unstyled mt-3 mb-3">
                    <li>0.1 CROPS</li>
                </ul>
                <p class="card-text mb-4">
                    Receive an amount of CROPS sufficient to establish a Bitcorns.com farm and gain access to basic and upload features, as well as the ability to create coops.
                </p>
                <button type="button" class="btn btn-lg btn-block btn-secondary" disabled>
                    <i class="fa fa-times"></i>
                    Sold Out
                </button>
            </div>
        </div>
    </div>
</div>
@endsection