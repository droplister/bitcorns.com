<div class="row">
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header">
                Supply
            </div>
            <div class="card-body">
                <p class="display-4">{{ $token->asset->divisible ? $token->supply_normalized : number_format($token->supply_normalized) }}</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-4">
        <div class="card mb-4">
            <div class="card-header">
                Holders
            </div>
            <div class="card-body">
                <p class="display-4">{{ number_format($balances->count()) }}</p>
            </div>
        </div>
    </div>
</div>