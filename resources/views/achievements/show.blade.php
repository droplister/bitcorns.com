@extends('layouts.app')

@section('title', $achievement->name)

@section('content')
<div class="container">
    @include('achievements.partials.show.head')
    @include('achievements.partials.show.body')
</div>
@endsection
