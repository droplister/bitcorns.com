@if($card->name === 'CORNFETTI' && $balance->quantity_normalized >= config('bitcorn.min_cornfetti'))
    <cornfetti></cornfetti>
@else
    <a href="{{ route('cards.show', ['card' => $card->slug]) }}">
        <img src="{{ $card->image_url }}" width="100%" alt="{{ $card->name }}" class="mb-3" />
    </a>
@endif
<h5 class="card-title d-none d-md-block">
    <a href="{{ route('cards.show', ['card' => $card->slug]) }}" class="text-dark">
        {{ $card->name }}
    </a>
</h5>
<h6 class="card-title d-block d-md-none">
    <a href="{{ route('cards.show', ['card' => $card->slug]) }}" class="text-dark">
        {{ $card->name }}
    </a>
</h6>
<p class="card-text">
    {{ number_format($balance->quantity_normalized) }}
</p>