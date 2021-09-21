@extends('layouts.app')

@section('title', 'Forecast')

@section('content')
<div class="container">
    <a href="{{ route('pages.calculator') }}" class="btn btn-outline-success float-right mt-3">
        <i class="fa fa-calculator"></i> <span class="d-none d-sm-inline">Calculator</span>
    </a>
    <a href="{{ route('harvests.index') }}" class="btn btn-outline-success d-none d-md-inline float-right mt-3 mr-3">
        &#x1f33d; Harvests
    </a>
    <h1 class="display-4 my-5">
        Forecast
    </h1>
    <div class="card mb-5">
        <div class="card-header">
            Harvest Schedule
        </div>
        <forecast crops="100"></forecast>
    </div>
    <a href="{{ route('pages.countdown', ['vision' => '2020']) }}" class="d-none d-md-inline">
        <img loading="lazy" src="{{ asset('images/3d-glasses.png') }}" alt="Dan's Vision" width="200" style="cursor: pointer" class="float-right mt-3" />
    </a>
    <h2 class="display-4 my-5">
        Countdown
    </h2>
    <div class="card">
        <countdown deadline="{{ $harvest->scheduled_at }}"></countdown>
    </div>
</div>
@endsection