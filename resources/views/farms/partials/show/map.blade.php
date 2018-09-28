@if($farm->latitude && $farm->longitude)
<div class="row mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header">
                Location <small class="text-muted">{{ $farm->latitude }}, {{ $farm->longitude }}</small>
            </div>
            <google-map v-bind:lat="{{ $farm->latitude }}" v-bind:lng="{{ $farm->longitude }}" v-bind:zoom="8"></google-map>
        </div>
    </div>
</div>
@endif