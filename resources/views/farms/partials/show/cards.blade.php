@if($upgrades->count() > 0)
    <div class="row mt-5">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="cardsTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="cards-tab" data-toggle="tab" href="#cards" role="tab" aria-controls="cards" aria-selected="true">Cards <span class="badge badge-dark">{{ $upgrades->count() }}</span></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body pb-0">
                    <div class="tab-content" id="cardsTabContent">
                        <div class="tab-pane fade show active" id="cards" role="tabpanel" aria-labelledby="cards-tab">
                            <div class="progress mt-1 mb-5">
                                <div class="progress-bar progress-bar-striped {{ $farm->progress < 50 ? 'bg-warning' : 'bg-success' }}" role="progressbar" style="width: {{ $farm->progress }}%" aria-valuenow="{{ $farm->progress }}" aria-valuemin="0" aria-valuemax="100">{{ $farm->progress }}%</div>
                            </div>
                            <div class="row text-left">
                                @foreach($upgrades as $balance)
                                    <div class="col-6 col-md-4 col-lg-3 mb-5 text-center">
                                        @include('farms.partials.show.card', ['card' => $balance->token])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif