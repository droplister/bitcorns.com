@extends('layouts.app')

@section('title', 'Bitcorn Farms')
@section('description', 'Explore the Bitcorn World! There are hundreds of bitcorn farms you can visit today.')

@section('content')
<div class="container">
    @include('farms.partials.index.head')
    @include('farms.partials.index.body')
</div>
@endsection