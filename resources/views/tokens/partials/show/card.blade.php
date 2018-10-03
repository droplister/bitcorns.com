<div class="card mb-4">
    <div class="card-header">
        Description
    </div>
    <div class="card-body">
        <p class="card-text">{{ $token->content }}</p>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="card mb-4">
            <div class="card-header">
                Last Price
            </div>
            <div class="card-body">
                <p class="card-text"><a href="{{ $last_match ? 'https://xcpdex.com/market/' . str_replace('/', '_', $last_match->trading_pair_normalized) : 'https://xcpdex.com/markets' }}" target="_blank">{{ $last_match ? $last_match->trading_price_normalized . ' ' . $last_match->trading_pair_quote_asset : __('No Trades') }}</a></p>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card mb-5">
            <div class="card-header">
                Supply
            </div>
            <div class="card-body">
                <p class="card-text">{{ $asset->divisible ? $asset->supply_normalized : number_format($asset->supply_normalized) }}</p>
            </div>
        </div>
    </div>
</div>