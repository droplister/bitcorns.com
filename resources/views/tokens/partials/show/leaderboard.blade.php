@if($farms->count())
<div class="card mb-4">
    <div class="card-header">
        Leaderboard
    </div>
    <div class="table-responsive">
        <table class="table mb-0" style="overflow-y: auto;white-space: nowrap;">
            <tbody>
                @foreach($farms as $farm)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}.</th>
                        <td><a href="{{ route('farms.show', ['farm' => $farm->slug]) }}">{{ $farm->name }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif