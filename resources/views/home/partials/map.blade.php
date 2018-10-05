<div class="row">
    <div class="col">
        <div class="card">
            <google-map v-bind:lat="{{ $geoip->latitude() ? $geoip->latitude() : 39.828175 }}" v-bind:lng="{{ $geoip->longitude() ? $geoip->longitude() : -98.5795 }}" v-bind:zoom="2"></google-map>
        </div>
    </div>
</div>
<h3 class="mt-3 lead text-muted text-center">
    <em>Bitcorns is an idle game of accumulation, similar to AdVenture Capitalist, where the only objective is to accumulate the most BITCORN.  Deceptively simple, accumulating BITCORN takes an amount of CROPS most people do not possess.</em>
</h3>