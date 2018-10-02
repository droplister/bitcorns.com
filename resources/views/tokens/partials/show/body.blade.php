@if($balances->count())
<div class="card mb-4">
    <div class="card-header">
        Bitcorn Farms
        <span class="badge badge-dark">
            {{ $balances->count() }}
        </span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0" style="overflow-y: auto;white-space: nowrap;">
            <thead>
                <th scope="col" style="width: 40px">#</th>
                <th scope="col">Name</th>
                <th scope="col">{{ $token->name }}</th>
                <th scope="col">Percent</th>
            </thead>
            <tbody>
                @foreach($balances as $balance)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}.</th>
                        <td><a href="{{ route('farms.show', ['farm' => $balance->farm->slug]) }}">{{ $balance->farm->name }}</a></td>
                        <td>{{ $balance->assetModel->divisible ? $balance->quantity_normalized : number_format($balance->quantity_normalized) }}</td>
                        <td>{{ number_format($balance->quantity_normalized / $asset->supply_normalized * 100, 2) }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif