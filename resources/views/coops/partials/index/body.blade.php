<div class="row mb-4">
    @foreach($coops as $coop)
        <div class="col-12 col-sm-6 mb-5">
            @include('coops.partials.index.card')
        </div>
        @if($loop->iteration % 2 === 0 && ! $loop->last)
            <div class="w-100"></div>
        @endif
    @endforeach
</div>