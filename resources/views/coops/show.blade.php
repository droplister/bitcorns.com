@extends('layouts.app')

@section('title', $coop->name)

@section('content')
<div class="container">
    @include('coops.partials.show.head')
    @include('coops.partials.show.body')
</div>
@endsection