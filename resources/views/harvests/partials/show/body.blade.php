@if($harvest->xcp_core_tx_index)
<h2 class="display-4 my-5">
    Noteworthy
</h2>
<div class="row">
    <div class="col-12 col-sm-6 mb-5">
        @include('harvests.partials.show.farm', ['farm' => $farms->first()])
    </div>
    <div class="col-12 col-sm-6 mb-5">
        @include('harvests.partials.show.coop', ['coop' => $coops->first()])
    </div>
</div>
<h2 class="display-4 mb-5">
    Top Coops
</h2>
<div class="card">
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
                    <th scope="col">Name</th>
                    <th scope="col">Farms</th>
                    <th scope="col">Harvest</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coops as $coop)
                    <tr>
                        <th>{{ $loop->iteration }}.</th>
                        <td><a href="{{ $coop->url }}">{{ $coop->name }}</a></td>
                        <td>{{ number_format($coop->harvestFarms($harvest)) }}</td>
                        <td>{{ number_format($coop->harvestTotal($harvest, true)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<h2 class="display-4 my-5">
    Top Farms
</h2>
<div class="card">
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
                    <th scope="col">Name</th>
                    <th scope="col">Coop</th>
                    <th scope="col">Harvest</th>
                </tr>
            </thead>
            <tbody>
                @foreach($farms as $farm)
                    <tr>
                        <th>
                            {{ $loop->iteration }}.
                        </th>
                        <td>
                            <a href="{{ $farm->url }}">{{ $farm->display_name }}</a>
                        </td>
                        <td>
                            @if($farm->harvestCoop($harvest))
                                <a href="{{ route('coops.show', ['coop' => $farm->harvestCoop($harvest)->slug]) }}">{{ $farm->harvestCoop($harvest)->name }}</a>
                            @endif
                        </td>
                        <td>
                            {{ number_format($farm->pivot->quantity * $farm->pivot->multiplier) }}
                            @if($farm->pivot->multiplier !== '1.00')
                                <span class="float-right {{ $farm->pivot->multiplier === '0.00' ? 'text-danger' : 'text-success' }}">
                                    {{ $farm->pivot->multiplier === '0.00' ? '-' : '+' }}{{ number_format(abs($farm->pivot->multiplier * 100 - 100)) }}%
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
