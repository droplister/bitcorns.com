<h2 class="display-4 my-5">
    Bitcorn Farms
</h2>
<div class="row">
    @foreach($farms as $farm)
        <div class="col-12 col-sm-6 col-md-4 mb-5">
            @include('home.partials.farm', ['farm' => $farm->featurable])
        </div>
    @endforeach
    @if($field)
        <div class="col-12 col-sm-6 col-md-4 mb-5">
            @include('home.partials.farm', ['farm' => $field])
        </div>
    @endif
</div>