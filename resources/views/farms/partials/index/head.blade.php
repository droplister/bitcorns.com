<div class="dropdown float-right mt-3 show">
    <a role="button" id="dropdownMenuLink" class="btn btn-primary dropdown-toggle" href="{{ url(route('farms.index')) }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       Sort
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
        <h6 class="dropdown-header">
            By Resource
        </h6>
        <a class="dropdown-item" href="{{ url(route('farms.index', ['sort' => 'crops'])) }}">
            <i class="fa fa-{{ $sort === 'crops' ? 'check-' : '' }}circle-o mr-1"></i>
            Crops
        </a>
        <a class="dropdown-item" href="{{ url(route('farms.index', ['sort' => 'bitcorn'])) }}">
            <i class="fa fa-{{ $sort === 'bitcorn' ? 'check-' : '' }}circle-o mr-1"></i>
            Bitcorn
        </a>
        <a class="dropdown-item" href="{{ url(route('farms.index', ['sort' => 'harvests'])) }}">
            <i class="fa fa-{{ $sort === 'harvests' ? 'check-' : '' }}circle-o mr-1"></i>
            Harvests
        </a>
        <h6 class="dropdown-header">
            Chronological
        </h6>
        <a class="dropdown-item" href="{{ url(route('farms.index', ['sort' => 'oldest'])) }}">
            <i class="fa fa-{{ $sort === 'oldest' ? 'check-' : '' }}circle-o mr-1"></i>
            Oldest
        </a>
        <a class="dropdown-item" href="{{ url(route('farms.index', ['sort' => 'newest'])) }}">
            <i class="fa fa-{{ $sort === 'newest' ? 'check-' : '' }}circle-o mr-1"></i>
            Newest
        </a>
        <a class="dropdown-item" href="{{ url(route('farms.index', ['sort' => 'updated'])) }}">
            <i class="fa fa-{{ $sort === 'updated' ? 'check-' : '' }}circle-o mr-1"></i>
            Updated
        </a>
        <h6 class="dropdown-header">
            Szaboan Desert
        </h6>
        <a class="dropdown-item" href="{{ url(route('farms.index', ['sort' => 'no-crops'])) }}">
            <i class="fa fa-{{ $sort === 'no-crops' ? 'check-' : '' }}circle-o mr-1"></i>
            No Crops
        </a>
    </div>
</div>
<h1 class="display-4 my-5">
    <span class="d-none d-sm-inline">Bitcorn</span> Farms
    <small class="lead d-none d-sm-inline">{{ $farms->total() }} Total</small>
</h1>