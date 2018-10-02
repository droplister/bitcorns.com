<div class="card">
    <div class="card-header">
        Top Farm
    </div>
    <a href="{{ route('farms.show', ['farm' => $farm->slug]) }}">
        <img src="{{ $farm->display_image_url }}" alt="{{ $farm->name }}" class="w-100">
    </a>
    <div class="card-body">
        <h4 class="card-title">
            <a href="{{ route('farms.show', ['farm' => $farm->slug]) }}">
                {{ $farm->name }}
            </a>
        </h4>
        <p class="card-text">
            {{ $card->name }}: {{ $asset->divisible ? $farm->getBalance($card->xcp_core_asset_name)->quantity_normalized : number_format($farm->getBalance($card->xcp_core_asset_name)->quantity_normalized) }}
        </p>
    </div>
</div>