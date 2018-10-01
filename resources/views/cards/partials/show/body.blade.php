@if($balances->count() > 0)
<h2 class="display-4 my-4">
    Bitcorn Farms
</h2>
<div class="card mb-4">
    <div class="card-header">
        Proud Owners
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @foreach($balances as $balance)
                <tr>
                    <th scope="row">{{ $loop->iteration }}.</th>
                    <td><a href="{{ route('farms.show', ['farm' => $balance->farm->slug]) }}">{{ $balance->farm->name }}</a></td>
                    <td>{{ number_format($balance->quantity_normalized) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif