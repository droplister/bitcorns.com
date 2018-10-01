<p>{{ $coop->content }}</p>
<div class="table-responsive">
    <table class="table mb-0 text-left" style="overflow-y: auto;white-space: nowrap;">
        <thead>
            <tr>
                <th scope="col">Farm</th>
                <th scope="col">{{ config('bitcorn.access_token') }}</th>
                <th scope="col">{{ config('bitcorn.reward_token') }}</th>
                <th scope="col">Harvested</th>
            </tr>
        </thead>
        <tbody>
            @foreach($farms as $farm)
                <tr>
                    <td>
                        <a href="{{ route('farms.show', ['farm' => $farm->slug]) }}">{{ $farm->name }}</a>
                    </td>
                    <td>{{ number_format($farm->accessBalance()->quantity_normalized, 8) }}</td>
                    <td>{{ number_format($farm->rewardBalance()->quantity_normalized) }}</td>
                    <td>{{ number_format($farm->total_harvested) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>