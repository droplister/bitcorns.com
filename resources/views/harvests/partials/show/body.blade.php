<h2 class="display-4 my-4">
    Bitcorn Farms
</h2>
<div class="responsive-table">
    <table class="table mb-0">
        <thead>
            <tr>      
                <th scope="col">Rank</th>
                <th scope="col">Farm</th>
                <th scope="col">Coop</th>
                <th scope="col">Quantity</th>
                <th scope="col">Multiplier</th>
            </tr>
        </thead>
        <tbody>
            @foreach($farms as $farm)
                <tr>
                    <th>{{ $loop->iteration }}.</th>
                    <td>{{ $farm->name }}</td>
                    <td></td>
                    <td>{{ number_format($farm->pivot->quantity * $farm->pivot->multiplier) }} </td>
                    <td>{{ number_format($farm->pivot->multiplier, 1) }}x</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>