@extends('layouts.app')

@section('title', $token->name)
@section('description', $token->content)

@section('content')
<div class="container">
    @include('tokens.partials.show.head')
    @include('tokens.partials.show.card')
    @include('tokens.partials.show.body')
</div>
@endsection
