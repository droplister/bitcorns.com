<div class="row">
    @foreach($harvests as $harvest)
        <div class="col-12">
            @include('harvests.partials.index.card')
        </div>
    @endforeach
</div>