@if($errors->isNotEmpty())
    <div class="alert alert-warning mb-5" role="alert">
        Error(s) Encountered - See warning messages below.
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-warning mb-5" role="alert">
        {{ session('error') }}
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success mb-5" role="alert">
        {{ session('success') }}
    </div>
@endif