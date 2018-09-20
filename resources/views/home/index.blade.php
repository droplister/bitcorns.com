@extends('layouts.app')

@section('title', 'Bitcorn Crops')

@section('content')
<div class="container">
    @include('pages.partials.buy.head')
    @include('pages.partials.buy.card', ['url' => route('pages.buy')])
</div>
@endsection