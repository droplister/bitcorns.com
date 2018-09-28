<div class="row mb-4">
    @foreach($farms as $farm)
        <div class="col-12 col-sm-6 col-md-4 mb-5">
            @include('farms.partials.index.card')
        </div>
        @if($loop->iteration % 3 === 0 && ! $loop->last)
            <div class="w-100"></div>
        @endif
    @endforeach
</div>
{!! $farms->appends(['sort' => $sort])->links() !!}