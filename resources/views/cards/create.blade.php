@extends('layouts.app')

@section('title', 'Submit Card')

@section('content')
<div class="container">
    @include('cards.partials.create.head')
    @include('cards.partials.create.card')
    @include('cards.partials.create.body')
</div>
@endsection
