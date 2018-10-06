<div class="row mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="achievementsTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="farm-tab" data-toggle="tab" href="#farm" role="tab" aria-controls="farm" aria-selected="true">      
                            Farm <span class="badge badge-dark">{{ $farm_achievements->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="token-tab" data-toggle="tab" href="#token" role="tab" aria-controls="token" aria-selected="true">
                            Token <span class="badge badge-dark">{{ $token_achievements->count() }}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="achievementsTabContent">
                    <div class="tab-pane fade show active" id="farm" role="tabpanel" aria-labelledby="farm-tab">
                        @include('achievements.partials.index.achievements', ['achievements' => $farm_achievements])
                    </div>
                    <div class="tab-pane fade" id="token" role="tabpanel" aria-labelledby="token-tab">
                        @include('achievements.partials.index.achievements', ['achievements' => $token_achievements])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>