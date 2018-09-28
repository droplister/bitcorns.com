@extends('layouts.app')

@section('title', $farm->display_name)
@section('description', $farm->content)

@section('meta')
    <meta property="og:title" content="{{ $farm->display_name }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('farms.show', ['farm' => $farm->slug]) }}" />
    <meta property="og:image" content="{{ $farm->display_image_url }}" />
@endsection

@section('content')
    @include('farms.partials.show.head')
    @include('farms.partials.show.body')
@endsection