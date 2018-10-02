<div class="card">
    <div class="card-header">
        Top Coop
    </div>
    <a href="{{ route('coops.show', ['coop' => $coop->slug]) }}">
        <img src="{{ $coop->image_url }}" alt="{{ $coop->name }}" class="w-100">
    </a>
    <div class="card-body">
        <h4 class="card-title">
            <a href="{{ route('coops.show', ['coop' => $coop->slug]) }}">
                {{ $coop->name }}
            </a>
        </h4>
        <p class="card-text">
            Harvested: {{ number_format($coop->harvestTotal($harvest, true)) }} {{ config('bitcorn.reward_token') }}
        </p>
    </div>
</div>