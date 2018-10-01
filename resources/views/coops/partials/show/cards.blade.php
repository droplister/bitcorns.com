<div class="progress mt-1 mb-5">
    <div class="progress-bar progress-bar-striped {{ $progress < 50 ? 'bg-warning' : 'bg-success' }}" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">{{ $progress }}%</div>
</div>
<div class="row text-left">
    @foreach($upgrades as $balance)
        <div class="col-6 col-md-4 col-lg-3 mb-5 text-center">
            @include('coops.partials.show.card', ['card' => $upgrade->token])
        </div>
    @endforeach
</div>