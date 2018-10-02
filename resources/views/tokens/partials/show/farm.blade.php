<div class="card mb-4">
    <div class="card-header">
        Top Farm
    </div>
    <a href="{{ route('farms.show', ['farm' => $farm->slug]) }}">
        <img src="{{ $farm->display_image_url }}" alt="{{ $farm->name }}" class="w-100 border-bottom">
    </a>
    <div class="card-body">
        <h4 class="card-title">
            <a href="{{ route('farms.show', ['farm' => $farm->slug]) }}">
                {{ $farm->name }}
            </a>
        </h4>
        <p class="card-text">
            {{ $token->name }}: {{ $asset->divisible ? $farm->getBalance($token->xcp_core_asset_name)->quantity_normalized : number_format($farm->getBalance($token->xcp_core_asset_name)->quantity_normalized) }}
        </p>
    </div>
</div>