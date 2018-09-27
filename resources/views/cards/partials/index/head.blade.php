<div class="dropdown float-right mt-3 show">
    <a role="button" id="dropdownMenuLink" class="btn btn-primary dropdown-toggle" href="{{ url(route('cards.index')) }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       Filter
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
        <h6 class="dropdown-header">
            Default
        </h6>
        <a class="dropdown-item" href="{{ url(route('cards.index')) }}">
            <i class="fa fa-{{ ! $filter ? 'check-' : '' }}circle-o mr-1"></i>
            None
        </a>
        <h6 class="dropdown-header">
            By Format
        </h6>
        @foreach(['GIF', 'JPG', 'PNG'] as $format)
            <a class="dropdown-item" href="{{ url(route('cards.index', ['filter' => $format])) }}">
                <i class="fa fa-{{ $filter === $format ? 'check-' : '' }}circle-o mr-1"></i>
                {{ $format }}
            </a>
        @endforeach
        <h6 class="dropdown-header">
            By Harvest
        </h6>
        @foreach($harvests as $harvest)
            <a class="dropdown-item" href="{{ url(route('cards.index', ['filter' => $harvest->id])) }}">
                <i class="fa fa-{{ (int) $filter === $harvest->id ? 'check-' : '' }}circle-o mr-1"></i>
                {{ str_replace('Bitcorn ', '', $harvest->name) }}
            </a>
        @endforeach
    </div>
</div>
<h1 class="display-4 my-5">
    <span class="d-none d-sm-inline">Bitcorn</span> Cards
    <small class="lead d-none d-sm-inline">{{ $cards->count() }} Total</small>
</h1>