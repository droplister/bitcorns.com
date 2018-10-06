<div class="row mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="achievementsTab" role="tablist">
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
                        @include('achievements.partials.show.achievements', ['achievements' => $unlocked_achievements, 'locked' => false])
                    </div>
                    <div class="tab-pane fade" id="locked" role="tabpanel" aria-labelledby="locked-tab">
                        @include('achievements.partials.show.achievements', ['achievements' => $locked_achievements, 'locked' => true])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>