<div class="card">
    <div class="card-header">
        Top Coop
    </div>
    <a href="{{ $coop->url }}">
        <img src="{{ $coop->image_url }}" alt="{{ $coop->name }}" class="w-100 border-bottom">
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
            {{ $card->name }}: {{ $asset->divisible ? $coop->getBalance($card->xcp_core_asset_name) : number_format($coop->getBalance($card->xcp_core_asset_name)) }}
        </p>
    </div>
</div>