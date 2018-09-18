<div class="card mb-4">
    <div class="card-header">
        Submit Your Card
    </div>
    <div class="card-body">
        <form action="{{ route('cards.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="burn">Burn TX Hash</label>
                <input id="burn" type="text" class="form-control{{ $errors->has('burn') ? ' is-invalid' : '' }}" name="burn" value="{{ old('burn') }}" required>
                @if ($errors->has('burn'))
                    <div class="invalid-feedback">
                         <strong>{{ $errors->first('burn') }}</strong>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="name">Asset Name</label>
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                         <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="image">Card Image</label>
                <input type="file" name="image" accept="image/png,image/gif" class="{{ $errors->has('image') ? 'is-invalid' : '' }}" required>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('image') }}</strong>
                    </div>
                @else
                    <small id="imageHelp" class="form-text text-muted">375x520 pixels. (Maximum: 2 MB)</small>
                @endif
            </div>
            <div class="form-group">
                <label for="hd_image">HD Image (Optional)</label>
                <input type="file" name="hd_image" accept="image/png,image/gif" class="{{ $errors->has('hd_image') ? 'is-invalid' : '' }}">
                @if($errors->has('hd_image'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('hd_image') }}</strong>
                    </div>
                @else
                    <small id="imageHelp" class="form-text text-muted">750x1040 pixels. (Maximum: 10 MB)</small>
                @endif
            </div>
            <div class="form-group">
                <label for="content">Description</label>
                <textarea id="content" type="text" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" required>{{ old('content') }}</textarea>
                @if ($errors->has('content'))
                    <div class="invalid-feedback">
                         <strong>{{ $errors->first('content') }}</strong>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Submit
                </button>
            </div>
        </form>
    </div>
</div>