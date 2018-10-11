@if($token->farmBalances()->count() && $token->type !== 'trophy')
    <h2 class="display-4 mb-5">
        Top Holders
    </h2>
    <div class="card mb-5">
        <div class="card-header">
            Bitcorn Farms
            <span class="badge badge-dark">
                {{ $token->farmBalances()->count() }}
            </span>
        </div>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <th scope="col" style="width: 40px">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Coop</th>
                    <th scope="col">{{ title_case($token->name) }}</th>
                    <th scope="col">Percent</th>
                </thead>
                <tbody>
                    @foreach($token->farmBalances as $balance)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}.</th>
                            <td><a href="{{ $balance->farm->url }}">{{ $balance->farm->name }}</a></td>
                            <td>
                                @if($balance->farm->coop)
                                    <a href="{{ $balance->farm->coop->url }}">{{ $balance->farm->coop->name }}</a>
                                @endif
                            </td>
                            <td>
                                @if($token->name === config('bitcorn.reward_token') && $balance->address === config('bitcorn.genesis_address'))
                                    {{ number_format($balance->quantity - \App\Harvest::upcoming()->sum('quantity')) }}
                                    <small class="d-block text-muted">
                                        {{ $balance->assetModel->divisible ? $balance->quantity_normalized : number_format($balance->quantity_normalized) }}
                                    </small>
                                @else
                                    {{ $balance->assetModel->divisible ? $balance->quantity_normalized : number_format($balance->quantity_normalized) }}
                                @endif
                            </td>
                            <td>
                                @if($token->name === config('bitcorn.reward_token') && $balance->address === config('bitcorn.genesis_address'))
                                    {{ number_format(($balance->quantity - \App\Harvest::upcoming()->sum('quantity')) / $token->asset->supply * 100, 2) }}%
                                    <small class="d-block text-muted">
                                        {{ number_format($balance->quantity_normalized / $token->asset->supply_normalized * 100, 2) }}%
                                    </small>
                                @else
                                    {{ number_format($balance->quantity_normalized / $token->asset->supply_normalized * 100, 2) }}%
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif