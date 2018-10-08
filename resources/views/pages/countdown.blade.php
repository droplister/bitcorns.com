@extends($request->has('vision') ? 'layouts.screen' : 'layouts.app')

@section('title', 'Countdown')

@section('content')
<div class="{{ $request->has('vision') ? 'glasses' : 'container' }}">
    @if(! $request->has('vision'))
        <a href="{{ route('pages.countdown', ['vision' => '2020']) }}" class="d-none d-md-inline">
            <img src="{{ asset('images/3d-glasses.png') }}" alt="Dan's Vision" width="200" style="cursor: pointer" class="float-right mt-3" />
        </a>
        <h1 class="display-4 my-5">
            Countdown
        </h1>
    @endif
    <countdown deadline="{{ $harvest->scheduled_at }}"></countdown>
</div>
@if($request->has('vision'))
    <div class="text-center my-5 py-5">
        <img src="{{ asset('/images/3D-glasses-icon.png') }}" />
        <a href="{{ config('bitcorn.glasses') }}" class="text-muted" target="_blank">Buy 3D Bitcorn Glasses</a>
    </div>
@endif
@endsection