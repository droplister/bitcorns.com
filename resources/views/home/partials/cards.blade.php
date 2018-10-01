<h2 class="display-4 mb-5">
    Bitcorn Cards
</h2>
<div class="row">
    @foreach($cards as $card)
        <div class="col-6 col-sm-4 col-lg-3 mb-4 text-center">
            @include('home.partials.card', ['card' => $card->featurable])
        </div>
    @endforeach
</div>