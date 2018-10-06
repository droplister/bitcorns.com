@extends('layouts.app')

@section('title', 'Achievements')

@section('content')
<div class="container">
    @include('achievements.partials.index.head')
    @include('achievements.partials.index.body')
</div>
@endsection
