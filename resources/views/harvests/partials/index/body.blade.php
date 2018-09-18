<div class="row">
    @foreach($harvests as $harvest)
        <div class="col">
            @include('harvests.partials.index.card')
        </div>
    @endforeach
</div>