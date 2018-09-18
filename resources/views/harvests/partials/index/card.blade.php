<div class="card">
    <div class="card-header">
        {{ $harvest->name }}
    </div>
    <div class="card-body">
        <p class="card-text">
            {{ $harvest->content }}
        </p>
    </div>
    <div class="card-footer">
        <div class="row text-muted">
            <div class="col">
                {{ number_format($harvest->quantity) }} {{ config('bitcorn.reward_token') }}
            </div>
            <div class="col text-right">
                {{ $harvest->scheduled_at->toDateTimeString() }}
            </div>
        </div>
    </div>
</div>