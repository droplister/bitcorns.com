<div class="content">
    <div class="container">
        @include('partials.session')
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="editTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="farm-tab" data-toggle="tab" href="#farm" role="tab" aria-controls="farm" aria-selected="true">
                                    Your Farm
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="coop-tab" data-toggle="tab" href="#coop" role="tab" aria-controls="coop" aria-selected="true">
                                    Your Coop
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="map-tab" data-toggle="tab" href="#map" role="tab" aria-controls="map" aria-selected="true">
                                    Location
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="editTabContent">
                            <div class="tab-pane fade show active" id="farm" role="tabpanel" aria-labelledby="farm-tab">
                                @include('farms.partials.edit.forms.farm')
                            </div>
                            <div class="tab-pane fade" id="coop" role="tabpanel" aria-labelledby="coop-tab">
                                @include('farms.partials.edit.forms.coop')
                            </div>
                            <div class="tab-pane fade" id="map" role="tabpanel" aria-labelledby="map-tab">
                                <map-editor
                                    farm="{{ $farm->slug }}"
                                    message="{{ config('bitcorn.message') }}"
                                    v-bind:lat="{{ $farm->mapMarker ? $farm->mapMarker->latitude : 39.828175 }}"
                                    v-bind:lng="{{ $farm->mapMarker ? $farm->mapMarker->longitude : -98.5795 }}"
                                    v-bind:zoom="8">
                                </map-editor>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>