<div class="card mb-4">
    <div class="row">
        <div class="col-sm-3">
            <a href="{{ route('harvests.show', ['harvest' => $harvest->id]) }}">
                <img src="{{ $harvest->image_url }}" alt="{{ $harvest->name }}" width="100%" />
            </a>
        </div>
        <div class="col-sm-9 col-md-10 mt-4">
            <h5 class="card-title">
                <a href="{{ route('harvests.show', ['harvest' => $harvest->id]) }}" class="text-dark">
                    {{ $harvest->name }}
                </a>
            </h5>
            <p class="card-text mb-0">
                {{ number_format($harvest->quantity) }} {{ config('bitcorn.reward_token') }}
            </p>
            <p class="card-text text-muted">
                {{ $harvest->xcp_core_tx_index ? 'Occurred' : 'Planned' }} {{ $harvest->scheduled_at->toDateString() }}
            </p>
            <a href="{{ route('harvests.show', ['harvest' => $harvest->id]) }}" class="btn btn-primary">
                Read Almanac &raquo;
            </a>
        </div>
    </div>
</div>