<p>{{ $coop->content }}</p>
<div class="table-responsive">
    <table class="table mb-0 text-left" style="overflow-y: auto;white-space: nowrap;">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">{{ title_case(config('bitcorn.access_token')) }}</th>
                <th scope="col">{{ title_case(config('bitcorn.reward_token')) }}</th>
                <th scope="col">Harvested</th>
                <th scope="col">Effective</th>
            </tr>
        </thead>
        <tbody>
            @foreach($farms as $farm)
                <tr>
                    <td>
                        <a href="{{ $farm->url }}">{{ $farm->name }}</a>
                    </td>
                    <td>{{ number_format($farm->accessBalance()->quantity_normalized, 8) }}</td>
                    <td>{{ number_format($farm->rewardBalance() ? $farm->rewardBalance()->quantity_normalized : 0) }}</td>
                    <td>{{ number_format($farm->coopTotal($coop)) }}</td>
                    <td>{{ number_format($farm->coopTotal($coop, true)) }}</td>
                </tr>
            @endforeach
            <tr>
                <th>Total:</th>
                <td>{{ number_format($coop->accessBalance(), 8) }}</td>
                <td>{{ number_format($coop->rewardBalance()) }}</td>
                <td>{{ number_format($coop->coopTotal()) }}</td>
                <td>{{ number_format($coop->total_harvested) }}</td>
            </tr>
        </tbody>
    </table>
</div>