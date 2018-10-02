<h2>Submission Form</h2>
<div class="card my-4">
    <div class="card-header">
        Submit Card
        <span class="badge badge-success">Fee: {{ number_format(config('bitcorn.subfee')) }} {{ config('bitcorn.reward_token') }}</span>
    </div>
    <div class="card-body">
        <form action="{{ route('cards.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="image" class="d-block">Card Image <span class="text-danger">*</span></label>
                        <input type="file" name="image" accept="image/png,image/gif" class="{{ $errors->has('image') ? 'is-invalid' : '' }}" required>
                        @if($errors->has('image'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('image') }}</strong>
                            </div>
                        @else
                            <small id="imageHelp" class="form-text text-muted">375x520 pixels. (Maximum: 2 MB)</small>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="hd_image" class="d-block">HD Image (Optional)</label>
                        <input type="file" name="hd_image" accept="image/png,image/gif" class="{{ $errors->has('hd_image') ? 'is-invalid' : '' }}">
                        @if($errors->has('hd_image'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('hd_image') }}</strong>
                            </div>
                        @else
                            <small id="imageHelp" class="form-text text-muted">750x1040 pixels. (Maximum: 10 MB)</small>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="burn">Burn TX Hash <span class="text-danger">*</span></label>
                <input id="burn" type="text" class="form-control{{ $errors->has('burn') ? ' is-invalid' : '' }}" name="burn" value="{{ old('burn') }}" required>
                @if($errors->has('burn'))
                    <div class="invalid-feedback">
                         <strong>{{ $errors->first('burn') }}</strong>
                    </div>
                @else
                    <small class="form-text text-muted">
                        Look up your send tx in <a href="https://xcpfox.com/transactions/sends" target="_blank">an explorer</a>. This is proof of submission fee.
                    </small>
                @endif
            </div>
            <div class="form-group">
                <label for="name">Asset Name <span class="text-danger">*</span></label>
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                         <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @else
                    <small class="form-text text-muted">
                        Counterparty asset name, all-caps, no spaces. (Must be registered.)
                    </small>
                @endif
            </div>
            <div class="form-group">
                <label for="content">Description <span class="text-danger">*</span></label>
                <textarea rows="5" id="content" type="text" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" required>{{ old('content') }}</textarea>
                @if($errors->has('content'))
                    <div class="invalid-feedback">
                         <strong>{{ $errors->first('content') }}</strong>
                    </div>
                @else
                    <small class="form-text text-muted">
                        What should people know? (This will be published on our website.)
                    </small>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-upload"></i> Submit for Review
                </button>
            </div>
        </form>
    </div>
</div>