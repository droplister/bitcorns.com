<div class="dropdown float-right mt-3 show">
    <a class="btn btn-primary dropdown-toggle" href="{{ url(route('farms.index')) }}" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       Sort
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
        <h6 class="dropdown-header">By Resource</h6>
        <a class="dropdown-item" href="{{ url(route('farms.index', ['sort' => 'access'])) }}"><i class="fa fa-{{ $sort === 'access' ? 'check-' : '' }}circle-o mr-1"></i> Most Crops</a>
        <a class="dropdown-item" href="{{ url(route('farms.index', ['sort' => 'reward'])) }}"><i class="fa fa-{{ $sort === 'reward' ? 'check-' : '' }}circle-o mr-1"></i> Most Bitcorn</a>
        <a class="dropdown-item" href="{{ url(route('farms.index', ['sort' => 'rewards'])) }}"><i class="fa fa-{{ $sort === 'rewards' ? 'check-' : '' }}circle-o mr-1"></i> Most Harvests</a>
        <h6 class="dropdown-header">Chronological</h6>
        <a class="dropdown-item" href="{{ url(route('farms.index', ['sort' => 'oldest'])) }}"><i class="fa fa-{{ $sort === 'oldest' ? 'check-' : '' }}circle-o mr-1"></i> Oldest Farms</a>
        <a class="dropdown-item" href="{{ url(route('farms.index', ['sort' => 'newest'])) }}"><i class="fa fa-{{ $sort === 'newest' ? 'check-' : '' }}circle-o mr-1"></i> Newest Farms</a>
        <a class="dropdown-item" href="{{ url(route('farms.index', ['sort' => 'updated'])) }}"><i class="fa fa-{{ $sort === 'updated' ? 'check-' : '' }}circle-o mr-1"></i> Updated Farms</a>
        <h6 class="dropdown-header">Szaboan Desert</h6>
        <a class="dropdown-item" href="{{ url(route('farms.index', ['sort' => 'no-access'])) }}"><i class="fa fa-{{ $sort === 'no-access' ? 'check-' : '' }}circle-o mr-1"></i> No Croppers</a>
    </div>
</div>