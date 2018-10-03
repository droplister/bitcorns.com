@extends('layouts.app')

@section('title', 'Countdown')

@section('content')
<div class="container">
    @if($request->has('vision'))
        <a href="{{ route('pages.countdown', ['vision' => '2020']) }">
            <img src="{{ asset('images/3d-glasses.png') }}" alt="Dan's Vision" width="200" style="cursor: pointer" class="float-right mt-3" />
        </a>
        <h1 class="display-4 my-5">
            Countdown
        </h1>
    @endif
    <countdown deadline="{{ $harvest->scheduled_at }}" vision="{{ $request->has('vision') ? 'true' : 'false' }}"></countdown>
</div>
@endsection