@extends('layouts.app')

@section('title', 'Bitcorn Harvests')

@section('content')
<div class="container">
    @include('harvests.partials.index.head')
    @include('harvests.partials.index.body')
</div>
@endsection
