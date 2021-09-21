<div class="card">
    <div class="card-header">
        Top Coop
    </div>
    <a href="{{ $coop->url }}">
        <img loading="lazy" src="{{ $coop->image_url }}" alt="{{ $coop->name }}" class="w-100 border-bottom">
    </a>
    <div class="card-body">
        <a href="{{ $coop->url }}" class="btn btn-outline-primary pull-right">
            <i class="fa fa-map-marker"></i>
        </a>
        <h4 class="card-title">
            <a href="{{ $coop->url }}">
                {{ $coop->name }}
            </a>
        </h4>
        <p class="card-text">
            Harvested: {{ number_format($coop->harvestTotal($harvest, true)) }} {{ config('bitcorn.reward_token') }}
        </p>
    </div>
</div>