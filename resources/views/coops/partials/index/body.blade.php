<div class="row mb-4">
    @foreach($coops as $coop)
        <div class="col-12 col-sm-6 col-md-4 mb-5">
            @include('coops.partials.index.card')
        </div>
        @if($loop->iteration % 3 === 0 && ! $loop->last)
            <div class="w-100"></div>
        @endif
    @endforeach
</div>