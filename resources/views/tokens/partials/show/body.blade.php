@if($balances->count() && $token->type !== 'trophy')
<h2 class="display-4 mb-5">
    Top Holders
</h2>
<div class="card mb-5">
    <div class="card-header">
        Bitcorn Farms
        <span class="badge badge-dark">
            {{ $balances->count() }}
        </span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0" style="overflow-y: auto;white-space: nowrap;">
            <thead>
                <th scope="col" style="width: 40px">#</th>
                <th scope="col">Name</th>
                <th scope="col">Coop</th>
                <th scope="col">{{ $token->name }}</th>
                <th scope="col">Percent</th>
            </thead>
            <tbody>
                @foreach($balances as $balance)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}.</th>
                        <td>
                            <a href="{{ route('farms.show', ['farm' => $balance->farm->slug]) }}">{{ $balance->farm->name }}</a>
                        </td>
                        <td>
                            @if($balance->farm->coop)
                                <a href="{{ route('coops.show', ['coop' => $balance->farm->coop->slug]) }}">{{ $balance->farm->coop->name }}</a>
                            @endif
                        </td>
                        <td>{{ $balance->assetModel->divisible ? $balance->quantity_normalized : number_format($balance->quantity_normalized) }}</td>
                        <td>{{ number_format($balance->quantity_normalized / $asset->supply_normalized * 100, 2) }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@if($token->type !== 'trophy')
    <h2 class="display-4 mb-5">
        Noteworthy
    </h2>
    <div class="row">
        <div class="col-12 col-sm-6 mb-5">
            @include('tokens.partials.show.farm', ['farm' => $top_farm])
        </div>
        <div class="col-12 col-sm-6 mb-5">
            @include('tokens.partials.show.coop', ['coop' => $top_coop])
        </div>
    </div>
@endif
@if($unlocked_achievements->count() + $locked_achievements->count() > 0)
<h2 class="display-4 mb-5">
    Achievements
</h2>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="achievementsTabContent" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="unlocked-tab" data-toggle="tab" href="#unlocked" role="tab" aria-controls="unlocked" aria-selected="true">
                            Unlocked <span class="badge badge-dark">{{ $unlocked_achievements->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="locked-tab" data-toggle="tab" href="#locked" role="tab" aria-controls="locked" aria-selected="true">
                            Locked <span class="badge badge-dark">{{ $locked_achievements->count() }}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="achievementsTabContent">
                    <div class="tab-pane fade show active" id="unlocked" role="tabpanel" aria-labelledby="unlocked-tab">
                        <div class="table-responsive">
                            <table class="table mb-0 text-left" style="overflow-y: auto;white-space: nowrap;">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Unlocked</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($unlocked_achievements as $achievement)
                                        <tr>
                                            <td>{{ $achievement->details->name }}</td>
                                            <td>{{ $achievement->details->description }}</td>
                                            <td>{{ $achievement->unlocked_at->format('M d, Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="locked" role="tabpanel" aria-labelledby="locked-tab">
                        <div class="table-responsive">
                            <table class="table mb-0 text-left" style="overflow-y: auto;white-space: nowrap;">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($locked_achievements as $achievement)
                                        <tr>
                                            <td>{{ $achievement->details->name }}</td>
                                            <td>{{ $achievement->details->description }}</td>
                                            <td>{{ number_format($achievement->points / $achievement->details->points * 100) }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif