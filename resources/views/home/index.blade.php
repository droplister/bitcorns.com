@extends('layouts.app')

@section('title', 'Blockchain Farming Game')

@section('content')
<div class="container">
    @include('pages.partials.buy.head')
    @include('pages.partials.buy.card', ['url' => route('pages.buy')])
</div>
@endsection