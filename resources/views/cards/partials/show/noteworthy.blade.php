@if($top_coop && $top_farm)
    <h2 class="display-4 mb-5">
        Noteworthy
    </h2>
    <div class="row">
        <div class="col-12 col-md-6 mb-5">
            @include('cards.partials.show.farm', ['farm' => $top_farm])
        </div>
        <div class="col-12 col-md-6 mb-5">
            @include('cards.partials.show.coop', ['coop' => $top_coop])
        </div>
    </div>
@endif