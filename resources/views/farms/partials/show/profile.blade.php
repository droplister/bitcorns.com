<div class="row">
    <div class="col">
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="playerTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">
                            Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="true">
                            History
                        </a>
                    </li>
                    <li class="nav-item d-none d-sm-inline">
                        <a class="nav-link" id="battle-tab" data-toggle="tab" href="#battle" role="tab" aria-controls="battle" aria-selected="true">
                            Battle
                        </a>
                    </li>
                    @if($farm->coop_id)
                        <li class="nav-item">
                            <a class="nav-link" id="coop-tab" data-toggle="tab" href="#coop" role="tab" aria-controls="coop" aria-selected="true">
                                Co-Op
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="playerTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <h5 class="card-title">
                            {{ $farm->name }}
                        </h5>
                        <p class="card-text">
                            {{ $farm->description }}
                        </p>
                        <a href="https://xcpfox.com/address/{{ $farm->slug }}" class="btn btn-primary" target="_blank">
                            <i class="fa fa-search"></i> View Address
                        </a>
                    </div>
                    <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                        <h5 class="card-title">
                            Farm Deed #{{ $farm->firstCrops->tx_index }}
                        </h5>
                        <p class="card-text">
                            {{ $farm->name }} was established {{ $farm->firstCrops->confirmed_at->toDateString() }} by a CROPS {{ $farm->firstCrops->action }}.
                        </p>
                        <a href="https://xcpfox.com/tx/{{ $farm->firstCrops->tx_index }}" class="btn btn-primary" target="_blank">
                            <i class="fa fa-search"></i> View Transaction
                        </a>
                    </div>
                    <div class="tab-pane fade" id="battle" role="tabpanel" aria-labelledby="battle-tab">
                        <h5 class="card-title">
                            Bitcorn Battle
                        </h5>
                        <p class="card-text">
                            Battle other bitcorn farms! (Requires <a href="{{ route('cards.show', ['card' => 'BATTLECORN']) }}">1 BATTLECORN</a>.)
                        </p>
                        <a href="http://bitcornbattle.com/?ref={{ $farm->slug }}" class="btn btn-primary" target="_blank">
                            <i class="fa fa-search"></i> Learn More
                        </a>
                    </div>
                    @if($farm->group_id)
                    <div class="tab-pane fade" id="coop" role="tabpanel" aria-labelledby="coop-tab">
                        <h5 class="card-title">
                            {{ $farm->coop->name }}
                        </h5>
                        <p class="card-text">
                            {{ $farm->coop->content }}
                        </p>
                        <a href="{{ route('groups.show', ['group' => $farm->group->slug]) }}" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Join Cooperative
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>