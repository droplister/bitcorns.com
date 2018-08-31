<div class="row">
    @foreach($cards as $card)
    <div class="col-6 col-sm-4 col-lg-3 mb-4 text-center">
        @include('cards.partials.index.card')
    </div>
    @endforeach
</div>