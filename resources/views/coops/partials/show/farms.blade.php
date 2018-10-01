<div class="row mt-1 mb-2 text-left">
    @foreach($tokens as $balance)
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <a href="{{ url(route('tokens.show', ['token' => $balance->token->slug])) }}">
                <img src="{{ $balance->token->image_url }}" alt="{{ $balance->token->name }}" class="float-left mr-3" width="30" />
            </a>
            <h4 class="card-title">
                <a href="{{ url(route('tokens.show', ['token' => $balance->token->slug])) }}" class="text-dark">
                    {{ $balance->token->name }}
                </a>
            </h4>
            <p class="card-text">
                {{ $balance->quantity_normalized }}
            </p>
        </div>
    @endforeach
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mb-4">
        <a href="{{ url(route('tokens.show', ['token' => 'SQUADGOALS'])) }}">
            <img src="{{ asset('images/tokens/SQUADGOALS.png') }}" class="float-left mr-3" />
        </a>
        <h4 class="card-title">
            <a href="{{ route('harvests.index') }}" class="text-dark">Harvested</a>
        </h4>
        <p class="card-text">
            {{ number_format($coop->total_harvested) }}
        </p>
    </div>
</div>

<div class="table-responsive">
    <table class="table mb-0 text-left" style="overflow-y: auto;white-space: nowrap;">
        <thead>
            <tr>
                <th>Farm Name</th>
                <th>{{ config('bitcorn.access_token') }}</th>
                <th>{{ config('bitcorn.reward_token') }}</th>
                <th>Harvested</th>
            </tr>
        </thead>
        <tbody>
            @foreach($farms as $farm)
                <tr>
                    <td>
                        <a href="{{ route('farms.show', ['farm' => $farm->slug]) }}">{{ $farm->name }}</a>
                    </td>
                    <td>{{ $farm->accessBalance()->quantity_normalized }}</td>
                    <td>{{ $farm->rewardBalance()->quantity_normalized }}</td>
                    <td>{{ number_format($farm->total_harvested) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>