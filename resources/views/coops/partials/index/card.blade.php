<div class="card">
    <a href="{{ $coop->url }}">
        <img src="{{ $coop->image_url }}" alt="{{ $coop->name }}" class="card-img-top border-bottom" />
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
            {{ config('bitcorn.access_token') }}: {{ $coop->accessBalance()->quantity_normalized }}
        </p>
    </div>
    <div class="card-footer text-muted">
        Farms: {{ $coop->farms_count }}
    </div>
</div>