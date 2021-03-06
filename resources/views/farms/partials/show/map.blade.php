@if($farm->mapMarker)
    <div class="row mt-5">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Location <small class="text-muted">{{ $farm->mapMarker->latitude }}, {{ $farm->mapMarker->longitude }}</small>
                </div>
                <google-map
                    type="{{ $farm->map_type }}"
                    farm="{{ $farm->slug }}"
                    v-bind:lat="{{ $farm->mapMarker->latitude }}"
                    v-bind:lng="{{ $farm->mapMarker->longitude }}"
                    v-bind:zoom="8">
                </google-map>
            </div>
        </div>
    </div>
@endif