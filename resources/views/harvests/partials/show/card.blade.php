<div class="card mb-4">
    <div class="row">
        <div class="col-sm-4 col-md-3">
            <img src="{{ $harvest->image_url }}" alt="{{ $harvest->name }}" width="100%" />
        </div>
        <div class="col-sm-8 col-md-9">
            <div class="harvest-body">
                <h5 class="card-title">
                    Top-Level
                </h5>
                <table class="table mb-0">
                    <thead>
                        <tr>      
                            <th scope="col" class="d-none d-md-block border-bottom-0">{{ $harvest->xcp_core_tx_index ? 'Harvested' : 'Scheduled' }}</th>
                            <th scope="col" class="border-bottom-0">Bitcorn</th>
                            <th scope="col" class="border-bottom-0">Farmers</th>
                            <th scope="col" class="border-bottom-0">Coops</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="d-none d-md-block">{{ $harvest->xcp_core_tx_index ? $harvest->transaction->confirmed_at->toDateString() :  $harvest->scheduled_at->toDateString() }}</td>
                            <td>{{ number_format($harvest->quantity) }}</td>
                            <td>{{ number_format($harvest->farms()->count()) }}</td>
                            <td>{{ number_format($harvest->coops()->count()) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>