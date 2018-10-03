<div class="card">
    <div class="card-header">
        Top Coop
    </div>
    <a href="{{ route('coops.show', ['coop' => $coop->slug]) }}">
        <img src="{{ $coop->image_url }}" alt="{{ $coop->name }}" class="w-100 border-bottom">
    </a>
    <div class="card-body">
        <a href="{{ route('coops.show', ['coop' => $coop->slug]) }}" class="btn btn-outline-primary pull-right">
            <i class="fa fa-map-marker"></i>
        </a>
        <h4 class="card-title">
            <a href="{{ route('coops.show', ['coop' => $coop->slug]) }}">
                {{ $coop->name }}
            </a>
        </h4>
        <p class="card-text">
            {{ $token->name }}: {{ $asset->divisible ? $coop->getBalance($token->xcp_core_asset_name) : number_format($coop->getBalance($token->xcp_core_asset_name)) }}
        </p>
    </div>
</div>