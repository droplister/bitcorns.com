<h2 class="display-4 my-5">
    <span class="d-none d-sm-inline">Featured</span> Farms
</h2>
<div class="row">
    @if($field)
        <div class="col-12 col-sm-6 col-md-4 mb-5">
            @include('home.partials.farm', ['farm' => $field])
        </div>
    @endif
    @foreach($farms as $farm)
        <div class="col-12 col-sm-6 col-md-4 mb-5{{ $loop->iteration > 2 ? ' d-none d-md-inline' : '' }}">
            @include('home.partials.farm', ['farm' => $farm->featurable])
        </div>
        @if($loop->iteration === 2)
            <div class="w-100"></div>
        @endif
    @endforeach
</div>
<div class="text-center mb-4">
    <a href="{{ route('farms.index') }}" class="btn btn-primary btn-lg">
        <i aria-hidden="true" class="fa fa-search"></i> Explore Farms
    </a>
</div>