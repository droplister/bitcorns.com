<div class="row">
    @foreach($farms as $farm)
    <div class="col-12 col-sm-6 col-md-4 mt-4 mb-2">
        @include('farms.partials.index.farm')
    </div>
    @if($loop->iteration % 3 === 0 && ! $loop->last)
        <div class="w-100"></div>
    @endif
    @endforeach
</div>
@if($paginated)
<br />
{!! $farms->appends(['sort' => $sort])->links() !!}
@endif