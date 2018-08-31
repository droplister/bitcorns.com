@if($balances->total() > 0)
<div class="card mb-4">
    <div class="card-header">
        Leaderboard
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <tbody>
                @foreach($balances as $balance)
                <tr>
                    <th scope="row" class="pl-4">{{ $loop->iteration }}.</th>
                    <td><a href="{{ route('farms.show', ['slug' => $balance->farm->slug]) }}">{{ $balance->farm->name }}</a></td>
                    <td class="text-muted d-none d-sm-block"><small>{{ $balance->farm->slug }}</small></td>
                    <td class="text-right">{{ $balance->quantity_normalized }} <span class="d-none d-sm-inline">{{ $token->name }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif