<div class="card">
    <a href="{{ $coop->url }}">
        <img src="{{ $coop->image_url }}" alt="{{ $coop->name }}" class="card-img-top border-bottom" />
    </a>
    <div class="card-body">
        <h4 class="card-title">
            <a href="{{ $coop->url }}">
                {{ $coop->name }}
            </a>
        </h4>
        <p class="card-text">
            {{ $coop->content }}
        </p>
    </div>
    <div class="card-footer text-muted">
        Member Farms: {{ $coop->farms_count }}
    </div>
</div>