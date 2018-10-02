<div class="card">
    <a href="{{ route('coops.show', ['coop' => $coop->slug]) }}">
        <img src="{{ $coop->image_url }}" alt="{{ $coop->name }}" class="card-img-top border-bottom" />
    </a>
    <div class="card-body">
        <a href="{{ route('coops.show', ['coop' => $coop->slug]) }}" class="btn btn-outline-primary pull-right">
            <i class="fa fa-search"></i>
        </a>
        <h4 class="card-title">
            <a href="{{ route('coops.show', ['coop' => $coop->slug]) }}">
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