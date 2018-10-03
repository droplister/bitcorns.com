<form role="form" method="POST" action="{{ route('farms.update', ['farm' => $farm->skug]) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="form-group">
        <input type="file" name="image" accept="image/jpeg,image/gif,image/png" class="{{ $errors->has('image') ? 'is-invalid' : '' }}" />
        @if($errors->has('image'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('image') }}</strong>
            </div>
        @else
            <small id="imageHelp" class="form-text text-muted">1600x900 pixels. (Maximum: 2.5 MB)</small>
        @endif
    </div>
    <h4>Guidelines:</h4>
    <ul class="mb-4">
        <li>Must be a depiction of a place or scene, i.e. "my farm looks like this."</li>
        <li>JPEG files only, at this time.</li>
    </ul>
    <hr class="mb-4" />
    <div class="form-group">
        <label for="message">Message</label>
        <input id="message" type="text" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" name="message" value="{{ config('bitcorn.message') }}" required>
        @if ($errors->has('message'))
            <div class="invalid-feedback">
                 <strong>{{ $errors->first('message') }}</strong>
            </div>
        @else
            <small id="messageHelp" class="form-text text-muted">Sign this message to authorize update.</small>
        @endif
    </div>
    <div class="form-group">
        <label for="signature">Signature</label>
        <input id="signature" type="text" class="form-control{{ $errors->has('signature') ? ' is-invalid' : '' }}" name="signature" value="{{ old('signature') }}" required>
        @if ($errors->has('signature'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('signature') }}</strong>
        </div>
        @else
        <small id="signatureHelp" class="form-text text-muted">Enter your signed message. <a href="https://youtu.be/AvPdaNb35qY" target="_blank"><i class="fa fa-external-link"></i> Tutorial</a></small>
        @endif
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Save
        </button>
    </div>
</form>