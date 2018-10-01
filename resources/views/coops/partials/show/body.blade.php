@include('coops.partials.show.map')
<div class="row mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="cardsTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="farms-tab" data-toggle="tab" href="#farms" role="tab" aria-controls="farms" aria-selected="true">Farms <span class="badge badge-dark">{{ count($farms) }}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="cards-tab" data-toggle="tab" href="#cards" role="tab" aria-controls="cards" aria-selected="true">Cards <span class="badge badge-dark">{{ count($upgrades) }}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="join-tab" data-toggle="tab" href="#join" role="tab" aria-controls="join" aria-selected="true"><i class="fa fa-users"></i> Join</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="cardsTabContent">
                    <div class="tab-pane fade show active" id="farms" role="tabpanel" aria-labelledby="farms-tab">
                        @include('coops.partials.show.farms')
                    </div>
                    <div class="tab-pane fade" id="cards" role="tabpanel" aria-labelledby="cards-tab">
                        @include('coops.partials.show.cards')
                    </div>
                    <div class="tab-pane fade" id="join" role="tabpanel" aria-labelledby="join-tab">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
