<a href="{{ url(route('cards.show', ['card' => $card->slug])) }}">
    <img src="{{ $card->image_url }}" width="100%" alt="{{ $card->name }}" class="mb-3" />
</a>
<h5 class="card-title d-none d-md-block">
    <a href="{{ url(route('cards.show', ['card' => $card->slug])) }}" class="text-dark">
        {{ $card->name }}
    </a>
</h5>
<h6 class="card-title d-block d-md-none">
    <a href="{{ url(route('cards.show', ['card' => $card->slug])) }}" class="text-dark">
        {{ $card->name }}
    </a>
</h6>
<p class="card-text">
    {{ number_format($balance->quantity_normalized) }}
</p>