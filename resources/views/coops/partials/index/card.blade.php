<div class="card mb-4">
    <div class="row">
        <div class="col-sm-4 col-md-3">
            <a href="{{ route('coops.show', ['coop' => $coop->slug]) }}">
                <img src="{{ $coop->image_url }}" alt="{{ $coop->name }}" width="100%" />
            </a>
        </div>
        <div class="col-sm-8 col-md-9">
            <div class="harvest-body">
                <h5 class="card-title">
                    <a href="{{ route('coops.show', ['coop' => $coop->slug]) }}" class="text-dark">
                        {{ $coop->name }}
                    </a>
                </h5>
            </div>
        </div>
    </div>
</div>