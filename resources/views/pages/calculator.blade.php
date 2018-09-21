@extends('layouts.app')

@section('title', 'Cornculator')

@section('content')
<div class="container">
    <forecast></forecast>
    <a href="{{ route('harvests.index') }}" class="btn btn-outline-success float-right mt-3 mr-3">
        &#x1f33d; <span class="d-none d-sm-inline">Harvests</span>
    </a>
    <h1 class="display-4 mt-5 mb-4">
        Cornculator
    </h1>
    <calculator crops="0.01" upcoming="{{ $upcoming ? $upcoming->id - 1 : $upcoming }}"></calculator>
</div>
@endsection