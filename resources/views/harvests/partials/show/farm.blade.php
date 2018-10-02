<div class="card">
    <div class="card-header">
        Top Farm
    </div>
    <a href="{{ route('farms.show', ['farm' => $farm->slug]) }}">
        <img src="{{ $farm->image_url }}" alt="{{ $farm->name }}" class="w-100">
    </a>
    <div class="card-body">
        <h4 class="card-title">
            <a href="{{ route('farms.show', ['farm' => $farm->slug]) }}">
                {{ $farm->name }}
            </a>
        </h4>
        <p class="card-text">
            Harvested: {{ number_format($farm->pivot->quantity * $farm->pivot->multiplier) }} {{ config('bitcorn.reward_token') }}
        </p>
    </div>
</div>