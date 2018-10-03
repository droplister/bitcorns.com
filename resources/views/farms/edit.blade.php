@extends('layouts.app')

@section('title', $farm->name)
@section('description', 'Edit Bitcorn Farm')

@section('meta')
    <meta name="robots" content="noindex,nofollow">
@endsection

@section('content')
    @include('farms.partials.edit.head')
    @include('farms.partials.edit.body')
@endsection