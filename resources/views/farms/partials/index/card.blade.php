<div class="card">
    <a href="{{ $farm->url }}">
        <img src="{{ $farm->display_image_url }}" alt="{{ $farm->display_name }}" class="card-img-top" />
    </a>
    <div class="card-body">
        <a href="{{ $farm->url }}" class="btn btn-outline-primary pull-right">
            <i class="fa fa-map-marker"></i>
        </a>
        <h4 class="card-title">
            <a href="{{ $farm->url }}">
                {{ $farm->display_name }}
            </a>
        </h4>
        <p class="card-text">
            @if($sort === 'cards')
                CARDS: {{ $farm->upgrade_balances_count }}
            @elseif($sort === 'crops')
                {{ config('bitcorn.access_token') }}: {{ $farm->accessBalance()->quantity_normalized }}
            @elseif($sort === 'bitcorn')
                {{ config('bitcorn.reward_token') }}: {{ number_format($farm->rewardBalance()->quantity_normalized) }}
            @endif
        </p>
    </div>
    <div class="card-footer">
        <div class="row text-muted">
            <div class="col">
                {{ $farm->firstCrops->confirmed_at->format('M d, Y') }}
            </div>
            <div class="col text-right">
                Harvests: {{ $farm->harvests_count }}
            </div>
        </div>
    </div>
</div>