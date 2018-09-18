@extends('layouts.app')

@section('title', $harvest->name)

@section('content')
<div class="container">
    @include('harvests.partials.show.head')
    @include('harvests.partials.show.body')
</div>
@endsection
