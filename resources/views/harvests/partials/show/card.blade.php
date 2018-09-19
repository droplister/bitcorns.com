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
                            <th scope="col" class="d-none d-md-inline">Harvested</th>
                            <th scope="col">Bitcorn</th>
                            <th scope="col">Farmers</th>
                            <th scope="col">Coops</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="d-none d-md-inline">{{ $harvest->scheduled_at->toDateString() }}</td>
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