<div class="card">
    <div class="card-header">
        {{ $harvest->scheduled_at->toDateString() }}
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3 col-md-2">
                <img src="{{ $harvest->image_url }}" alt="{{ $harvest->name }}" width="100%" />
            </div>
            <div class="col-sm-9 col-md-10">
                <h5 class="card-title">
                    {{ $harvest->name }}
                </h5>
                <p class="card-text">
                    {{ number_format($harvest->quantity) }} {{ config('bitcorn.reward_token') }}
                </p>
                <p class="card-text">
                    {{ $harvest->content }}
                </p>
                @if($harvest->xcp_core_tx_index)
                    <a href="{{ route('harvests.show', ['harvest' => $harvest->id]) }}" class="btn btn-primary">
                        Read Almanac
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>