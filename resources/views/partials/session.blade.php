@if($errors->isNotEmpty())
    <div class="alert alert-warning mb-4" role="alert">
        Error(s) Encountered - See warning messages below.
    </div>
@endif
@if(session('error'))
    <div class="alert alert-warning mb-4" role="alert">
        {{ session('error') }}
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success mb-4" role="alert">
        {{ session('success') }}
    </div>
@endif