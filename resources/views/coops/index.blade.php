@extends('layouts.app')

@section('title', 'Bitcorn Coops')

@section('content')
<div class="container">
    @include('coops.partials.index.head')
    @include('coops.partials.index.body')
</div>
@endsection