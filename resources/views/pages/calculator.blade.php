@extends('layouts.app')

@section('title', 'Calculator')

@section('content')
<div class="container">
    <a href="{{ route('pages.forecast') }}" class="btn btn-outline-success float-right mt-3">
        <i class="fa fa-line-chart"></i> <span class="d-none d-sm-inline">Forecast</span>
    </a>
    <a href="{{ route('harvests.index') }}" class="btn btn-outline-success d-none d-md-inline float-right mt-3 mr-3">
        &#x1f33d; Harvests
    </a>
    <h1 class="display-4 mt-5 mb-4">
        Calculator
    </h1>
    <calculator crops="0.1" upcoming="{{ $upcoming ? $upcoming->id - 1 : $upcoming }}"></calculator>
</div>
@endsection