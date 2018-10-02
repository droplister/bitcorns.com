@if($harvest->xcp_core_tx_index)
<div class="row my-4">
    <div class="col-12 col-sm-6">
        @include('harvests.partials.show.coop', ['coop' => $coops[0]])
    </div>
    <div class="col-12 col-sm-6">
        @include('harvests.partials.show.farm', ['farm' => $farms[0]])
    </div>
</div>
<div class="card my-4">
    <div class="card-header">
        Bitcorn Coops
        <span class="badge badge-dark">
            {{ $coops->count() }}
        </span>
    </div>
    <div class="responsive-table">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>      
                    <th scope="col" style="width: 40px">#</th>
                    <th scope="col">Coop</th>
                    <th scope="col">Farms</th>
                    <th scope="col">Harvested</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coops as $coop)
                    <tr>
                        <th>{{ $loop->iteration }}.</th>
                        <td><a href="{{ route('coops.show', ['coop' => $coop->slug]) }}">{{ $coop->name }}</a></td>
                        <td>{{ number_format($coop->harvestFarms($harvest)) }}</td>
                        <td>{{ number_format($coop->harvestTotal($harvest, true)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="card my-4">
    <div class="card-header">
        Bitcorn Farms
        <span class="badge badge-dark">
            {{ $farms->count() }}
        </span>
    </div>
    <div class="responsive-table">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>      
                    <th scope="col" style="width: 40px">#</th>
                    <th scope="col">Farm</th>
                    <th scope="col">Coop</th>
                    <th scope="col">Harvested</th>
                </tr>
            </thead>
            <tbody>
                @foreach($farms as $farm)
                    <tr>
                        <th>{{ $loop->iteration }}.</th>
                        <td><a href="{{ route('farms.show', ['farm' => $farm->slug]) }}">{{ $farm->display_name }}</a></td>
                        <td>
                            @if($farm->harvestCoop($harvest))
                                <a href="{{ route('coops.show', ['coop' => $farm->harvestCoop($harvest)->slug]) }}">{{ $farm->harvestCoop($harvest)->name }}</a>
                            @endif
                        </td>
                        <td>
                            {{ number_format($farm->pivot->quantity * $farm->pivot->multiplier) }}
                            <small class="text-muted">{{ number_format($farm->pivot->multiplier, 1) }}x</small>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
