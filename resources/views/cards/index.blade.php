@extends('layouts.app')

@section('title', 'Bitcorn Cards')

@section('content')
<div class="container">
    @include('cards.partials.index.head')
    @include('cards.partials.index.body')
</div>
@endsection
