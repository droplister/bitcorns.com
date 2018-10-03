<div class="card mb-5">
    <div class="row">
        <div class="col-sm-4 col-md-3">
            <img src="{{ $harvest->image_url }}" alt="{{ $harvest->name }}" width="100%" />
        </div>
        <div class="col-sm-8 col-md-9">
            <div class="harvest-body">
                <h5 class="card-title">
                    {{ $harvest->scheduled_at->toFormattedDateString() }}
                </h5>
                <p>{{ $harvest->content }}</p>
                <table class="table mb-0">
                    <thead>
                        <tr>      
                            <th scope="col" class="d-none d-md-block border-bottom-0">{{ $harvest->xcp_core_tx_index ? 'Harvested' : 'Scheduled' }}</th>
                            <th scope="col" class="border-bottom-0">Bitcorn</th>
                            <th scope="col" class="border-bottom-0">Farms</th>
                            <th scope="col" class="border-bottom-0">Coops</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if($harvest->xcp_core_tx_index)
                                <td class="d-none d-md-block">
                                    <a href="https://xcpfox.com/tx/{{ $harvest->dividend->tx_hash }}" target="_blank">
                                        {{ $harvest->scheduled_at->toDateString() }}
                                    </a>
                                </td>
                            @else
                                <td class="d-none d-md-block">{{ $harvest->scheduled_at->toDateString() }}</td>
                            @endif
                            <td>{{ number_format($harvest->quantity) }}</td>
                            <td>{{ $harvest->xcp_core_tx_index ? number_format($farms->count()) : 'TBD' }}</td>
                            <td>{{ $harvest->xcp_core_tx_index ? number_format($coops->count()) : 'TBD' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>