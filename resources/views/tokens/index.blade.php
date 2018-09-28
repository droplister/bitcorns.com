@extends('layouts.app')

@section('title', 'Game Tokens')

@section('content')
<div class="container">
    @include('tokens.partials.index.head')
    @include('tokens.partials.index.body')
</div>
@endsection
