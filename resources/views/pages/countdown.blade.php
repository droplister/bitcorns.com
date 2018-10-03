@extends($request->has('vision') ? 'layouts.screen' : 'layouts.app')

@section('title', 'Countdown')

@section('content')
<div class="container{{ $request->has('vision') ? ' glasses' : '' }}">
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
@endsection