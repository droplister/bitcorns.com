@if($card->unlockedAchievements()->count() + $card->lockedAchievements()->count() > 0)
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
                                Unlocked <span class="badge badge-dark">{{ $card->unlockedAchievements()->count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="locked-tab" data-toggle="tab" href="#locked" role="tab" aria-controls="locked" aria-selected="true">
                                Locked <span class="badge badge-dark">{{ $card->lockedAchievements()->count() }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="achievementsTabContent">
                        <div class="tab-pane fade show active" id="unlocked" role="tabpanel" aria-labelledby="unlocked-tab">
                            <div class="table-responsive">
                                <table class="table mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Unlocked</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($card->unlockedAchievements() as $achievement)
                                            <tr>
                                                <td><a href="{{ route('achievements.show', ['achievement' => $achievement->achievement_id]) }}">{{ $achievement->details->name }}</a></td>
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
                                <table class="table mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($card->lockedAchievements() as $achievement)
                                            <tr>
                                                <td><a href="{{ route('achievements.show', ['achievement' => $achievement->achievement_id]) }}">{{ $achievement->details->name }}</a></td>
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