<a href="{{ route('cards.show', ['card' => $card->slug]) }}">
    <img src="{{ $card->image_url }}" width="100%" alt="{{ $card->name }}" class="mb-3" />
</a>
<h6 class="card-title d-block d-md-none">
    <a href="{{ route('cards.show', ['card' => $card->slug]) }}" class="text-dark">
        {{ $card->name }}
    </a>
</h6>