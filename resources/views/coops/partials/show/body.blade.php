@include('coops.partials.show.map')
<div class="row mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="cardsTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="farms-tab" data-toggle="tab" href="#farms" role="tab" aria-controls="farms" aria-selected="true">Farms <span class="badge badge-dark">{{ count($farms) }}</span></a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="cardsTabContent">
                    <div class="tab-pane fade show active" id="farms" role="tabpanel" aria-labelledby="farms-tab">
                        @include('coops.partials.show.farms')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
