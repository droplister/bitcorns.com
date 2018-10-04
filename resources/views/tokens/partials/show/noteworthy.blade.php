@if($token->type !== 'trophy')
    <h2 class="display-4 mb-5">
        Noteworthy
    </h2>
    <div class="row">
        <div class="col-12 col-sm-6 mb-5">
            @include('tokens.partials.show.farm', ['farm' => $token->topFarm()])
        </div>
        <div class="col-12 col-sm-6 mb-5">
            @include('tokens.partials.show.coop', ['coop' => $token->topCoop()])
        </div>
    </div>
@endif