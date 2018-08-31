<h5 class="card-title d-none d-md-block">
    <a href="{{ url(route('cards.show', ['token' => $card->name])) }}" class="text-dark">
        {{ $card->name }}
    </a>
</h5>
<h6 class="card-title d-block d-md-none">
    <a href="{{ url(route('cards.show', ['token' => $card->name])) }}" class="text-dark">
        {{ $card->name }}
    </a>
</h6>
<p class="card-text d-none d-md-block">
    Harvest #{{ $card->harvest_id }} / Card #{{ $card->meta_data['overall_ranking'] }}
</p>
<a href="{{ url(route('cards.show', ['token' => $card->name])) }}">
    <img src="{{ $card->image_url }}" width="100%" alt="{{ $card->name }}" />
</a>
<h6 class="card-title mt-3 d-block d-md-none">
    Card #{{ $card->meta_data['overall_ranking'] }}
</h6>