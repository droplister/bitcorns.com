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
    <h1 class="display-4 mt-5 mb-4">
        Forecast
    </h1>
    <forecast crops="100"></forecast>
</div>
@endsection