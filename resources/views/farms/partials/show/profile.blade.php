<div class="row">
    <div class="col">
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="farmTab" role="tablist">
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
                            Battles
                        </a>
                    </li>
                    @if($farm->coop)
                        <li class="nav-item">
                            <a class="nav-link" id="coop-tab" data-toggle="tab" href="#coop" role="tab" aria-controls="coop" aria-selected="true">
                                Co-Op
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="farmTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <h5 class="card-title">
                            {{ $farm->display_name }}
                        </h5>
                        <p class="card-text">
                            {{ $farm->display_content }}
                        </p>
                        <a href="https://xcpfox.com/address/{{ $farm->slug }}" class="btn btn-primary" target="_blank">
                            <i class="fa fa-search"></i> View Address
                        </a>
                    </div>
                    <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                        <h5 class="card-title">
                            Farm Deed #{{ $farm->id }}
                        </h5>
                        <p class="card-text">
                            {{ $farm->display_name }} was established {{ $farm->firstCrops ? $farm->firstCrops->confirmed_at->format('M d, Y') : $farm->created_at->format('M d, Y') }} by a {{ config('bitcorn.access_token') }} {{ $farm->firstCrops ? $farm->firstCrops->action : 'syncing' }}.
                        </p>
                        <a href="https://xcpfox.com/block/{{ $farm->firstCrops ? $farm->firstCrops->block_index : 'syncing' }}" class="btn btn-primary" target="_blank">
                            <i class="fa fa-search"></i> View Block
                        </a>
                    </div>
                    <div class="tab-pane fade" id="battle" role="tabpanel" aria-labelledby="battle-tab">
                        <h5 class="card-title">
                            Wins: {{ $farm->getBattleStat('wins') }} - Losses: {{ $farm->getBattleStat('losses') }}
                        </h5>
                        <p class="card-text">
                            Battle other farms in Bitcorn Battle!
                        </p>
                        <a href="{{ config('bitcorn.bitcornbattle') }}" class="btn btn-primary" target="_blank">
                            <i class="fa fa-search"></i> Learn More
                        </a>
                    </div>
                    @if($farm->coop)
                        <div class="tab-pane fade" id="coop" role="tabpanel" aria-labelledby="coop-tab">
                            <h5 class="card-title">
                                {{ $farm->coop->name }}
                            </h5>
                            <p class="card-text">
                                {{ $farm->coop->content }}
                            </p>
                            <a href="{{ $farm->coop->url }}" class="btn btn-primary">
                                <i class="fa fa-search"></i> Learn More
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>