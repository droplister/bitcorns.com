@if(count($upgrades))
<div class="row mt-5">
    <div class="col">
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="cardsTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="cards-tab" data-toggle="tab" href="#cards" role="tab" aria-controls="cards" aria-selected="true">Cards <span class="badge badge-dark">{{ count($upgrades) }}</span></a>
                    </li>
                </ul>
            </div>
            <div class="card-body pb-0">
                <div class="tab-content" id="cardsTabContent">
                    <div class="tab-pane fade show active" id="cards" role="tabpanel" aria-labelledby="cards-tab">
                        <div class="progress mt-1 mb-5">
                            <div class="progress-bar progress-bar-striped {{ $progress < 50 ? 'bg-warning' : 'bg-success' }}" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">{{ $progress }}%</div>
                        </div>
                        <div class="row text-left">
                            @foreach($upgrades as $upgrade)
                            <div class="col-6 col-md-4 col-lg-3 mb-5 text-center">
                                @include('farms.partials.show.upgrade', ['card' => $upgrade->token])
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