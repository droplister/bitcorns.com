@if($balances->count() > 0)
    <h2 class="display-4 mb-5">
        Card Owners
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
                    <tr>
                        <th scope="col" style="width: 40px">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Coop</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Percent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($balances as $balance)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}.</th>
                        <td>
                            @if($asset->owner === $balance->farm->xcp_core_address)
                                <small><i class="fa fa-paint-brush text-success" title="Card Owner"></i></small>
                            @endif
                            <a href="{{ route('farms.show', ['farm' => $balance->farm->slug]) }}">{{ $balance->farm->name }}</a>
                        </td>
                        <td>
                            @if($balance->farm->coop)
                                <a href="{{ route('coops.show', ['coop' => $balance->farm->coop->slug]) }}">{{ $balance->farm->coop->name }}</a>
                            @endif
                        </td>
                        <td>{{ number_format($balance->quantity_normalized) }}</td>
                        <td>{{ number_format($balance->quantity_normalized / $card->asset->supply_normalized * 100, 2) }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif