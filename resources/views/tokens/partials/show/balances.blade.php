@if($balances->count() && $token->type !== 'trophy')
    <h2 class="display-4 mb-5">
        Top Holders
    </h2>
    <div class="card mb-5">
        <div class="card-header">
            Bitcorn Farms
            <span class="badge badge-dark">
                {{ $balances->count() }}
            </span>
        </div>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <th scope="col" style="width: 40px">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Coop</th>
                    <th scope="col">{{ $token->name }}</th>
                    <th scope="col">Percent</th>
                </thead>
                <tbody>
                    @foreach($balances as $balance)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}.</th>
                            <td>
                                <a href="{{ $balance->farm->url }}">{{ $balance->farm->name }}</a>
                            </td>
                            <td>
                                @if($balance->farm->coop)
                                    <a href="{{ $balance->farm->coop->url }}">{{ $balance->farm->coop->name }}</a>
                                @endif
                            </td>
                            <td>{{ $balance->assetModel->divisible ? $balance->quantity_normalized : number_format($balance->quantity_normalized) }}</td>
                            <td>{{ number_format($balance->quantity_normalized / $asset->supply_normalized * 100, 2) }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif