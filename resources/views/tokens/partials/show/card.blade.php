<div class="card mb-4">
    <div class="card-header">
        Description
    </div>
    <div class="card-body">
        <p class="card-text">
            {{ $token->content }}
        </p>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="card mb-4">
            <div class="card-header">
                Last Price
            </div>
            <div class="card-body">
                <p class="card-text">
                    <a href="{{ $token->lastMatch('XCP') ? 'https://xcpdex.com/market/' . str_replace('/', '_', $token->lastMatch('XCP')->trading_pair_normalized) : 'https://xcpdex.com/markets' }}" target="_blank">
                        {{ $token->lastMatch('XCP') ? $token->lastMatch('XCP')->trading_price_normalized . ' ' . $token->lastMatch('XCP')->trading_pair_quote_asset : __('No Trades') }}
                    </a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card mb-5">
            <div class="card-header">
                Supply
            </div>
            <div class="card-body">
                <p class="card-text">
                    @if($token->name === config('bitcorn.reward_token'))
                        {{ number_format(\App\Harvest::complete()->sum('quantity')) }}
                        <small class="text-muted">
                            {{ $token->asset->divisible ? $token->asset->supply_normalized : number_format($token->asset->supply_normalized) }}
                        </small>
                    @else
                        {{ $token->asset->divisible ? $token->asset->supply_normalized : number_format($token->asset->supply_normalized) }}
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>