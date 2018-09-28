@extends('layouts.app')

@section('title', $card->name)

@section('content')
<div class="container">
    @include('cards.partials.show.card')
    @include('cards.partials.show.body')
</div>
@endsection
