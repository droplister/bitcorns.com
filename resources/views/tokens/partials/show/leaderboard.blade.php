@if($balances->count())
<div class="card mb-4">
    <div class="card-header">
        Leaderboard
    </div>
    <div class="table-responsive">
        <table class="table mb-0" style="overflow-y: auto;white-space: nowrap;">
            <tbody>
                @foreach($balances as $balance)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}.</th>
                        <td><a href="{{ route('farms.show', ['farm' => $balance->farm->slug]) }}">{{ $balance->farm->name }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif