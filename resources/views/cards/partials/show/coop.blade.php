<div class="card mb-4">
    <div class="card-header">
        Top Coop
    </div>
    <a href="{{ route('coops.show', ['coop' => $coop->slug]) }}">
        <img src="{{ $coop->image_url }}" alt="{{ $coop->name }}" class="w-100 border-bottom">
    </a>
    <div class="card-body">
        <h4 class="card-title">
            <a href="{{ route('coops.show', ['coop' => $coop->slug]) }}">
                {{ $coop->name }}
            </a>
        </h4>
        <p class="card-text">
            {{ $card->name }}: {{ $asset->divisible ? $coop->getBalance($card->xcp_core_asset_name) : number_format($coop->getBalance($card->xcp_core_asset_name)) }}
        </p>
    </div>
</div>