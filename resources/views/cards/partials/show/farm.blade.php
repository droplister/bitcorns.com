<div class="card">
    <div class="card-header">
        Top Farm
    </div>
    <a href="{{ $farm->url }}">
        <img loading="lazy" src="{{ $farm->display_image_url }}" alt="{{ $farm->name }}" class="w-100 border-bottom">
    </a>
    <div class="card-body">
        <a href="{{ $farm->url }}" class="btn btn-outline-primary pull-right">
            <i class="fa fa-map-marker"></i>
        </a>
        <h4 class="card-title">
            <a href="{{ $farm->url }}">
                {{ $farm->name }}
            </a>
        </h4>
        <p class="card-text">
            {{ $card->name }}: {{ $card->asset->divisible ? $farm->getBalance($card->xcp_core_asset_name)->quantity_normalized : number_format($farm->getBalance($card->xcp_core_asset_name)->quantity_normalized) }}
        </p>
    </div>
</div>