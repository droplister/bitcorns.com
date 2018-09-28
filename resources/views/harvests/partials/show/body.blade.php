<h2 class="display-4 my-4">
    Bitcorn Coops
</h2>
<div class="responsive-table">
    <table class="table table-bordered mb-0">
        <thead>
            <tr>      
                <th scope="col">#</th>
                <th scope="col">Coop</th>
                <th scope="col">Farms</th>
                <th scope="col">Harvested</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coops as $coop)
                <tr>
                    <th>{{ $loop->iteration }}.</th>
                    <td>{{ $coop->name }}</td>
                    <td>{{ number_format($coop->harvestFarms($harvest)) }} </td>
                    <td>{{ number_format($coop->harvestTotal($harvest, true)) }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<h2 class="display-4 my-4">
    Bitcorn Farms
</h2>
<div class="responsive-table">
    <table class="table table-bordered mb-0">
        <thead>
            <tr>      
                <th scope="col">#</th>
                <th scope="col">Farm</th>
                <th scope="col">Coop</th>
                <th scope="col">Multiplier</th>
                <th scope="col">Harvested</th>
            </tr>
        </thead>
        <tbody>
            @foreach($farms as $farm)
                <tr>
                    <th>{{ $loop->iteration }}.</th>
                    <td>{{ $farm->name }}</td>
                    <td>{{ $farm->harvestCoop($harvest) ? $farm->harvestCoop($harvest)->name : ''  }}</td>
                    <td>{{ number_format($farm->pivot->multiplier, 1) }}x</td>
                    <td>{{ number_format($farm->pivot->quantity * $farm->pivot->multiplier) }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>