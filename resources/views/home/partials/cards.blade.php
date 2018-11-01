<h2 class="display-4 mb-5">
    <span class="d-none d-sm-inline">Featured</span> Cards
</h2>
<div class="row">
    @foreach($cards as $card)
        <div class="col-6 col-sm-4 col-lg-3 mb-4 text-center{{ $loop->iteration > 4 ? ' d-none d-md-inline' : '' }}">
            @include('home.partials.card', ['card' => $card->featurable])
        </div>
        @if($loop->iteration === 4)
            <div class="w-100"></div>
        @endif
    @endforeach
</div>
<div class="text-center mb-5">
    <a href="{{ route('cards.index') }}" class="btn btn-primary btn-lg">
        <i aria-hidden="true" class="fa fa-list"></i> Card Directory
    </a>
</div>