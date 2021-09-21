<form role="form" method="POST" action="{{ route('farms.update', ['farm' => $farm->slug]) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="form-group">
        <label for="name">Farm Name</label>
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ? old('name') : $farm->name }}">
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                 <strong>{{ $errors->first('name') }}</strong>
            </div>
        @else
            <small id="nameHelp" class="form-text text-muted">Max Length: 30 characters.</small>
        @endif
    </div>
    <div class="form-group">
        <label for="content">Description</label>
        <input id="content" type="text" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" value="{{ old('content') ? old('content') : $farm->content }}">
        @if ($errors->has('content'))
            <div class="invalid-feedback">
                 <strong>{{ $errors->first('content') }}</strong>
            </div>
        @else
            <small id="contentHelp" class="form-text text-muted">Max Length: 255 characters.</small>
        @endif
    </div>
    <div class="form-group">
        <label for="image" class="d-block">Farm Image</label>
        <input type="file" name="image" accept="image/jpeg,image/gif,image/png" class="{{ $errors->has('image') ? 'is-invalid' : '' }}" />
        @if($errors->has('image'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('image') }}</strong>
            </div>
        @else
            <small id="imageHelp" class="form-text text-muted">1600x900 pixels. (Maximum: 2.5 MB)</small>
        @endif
        <ul class="my-4">
            <li>Must be a depiction of a place.</li>
            <li>JPEG files only, at this time.</li>
        </ul>
    </div>
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
        <label for="signature">Signature <a href="counterparty:?action=sign&message=I authorize this change."><i class="fa fa-edit"></i></a></label>
        <input id="signature" type="text" class="form-control{{ $errors->has('signature') ? ' is-invalid' : '' }}" name="signature" value="{{ old('signature') }}" required>
        @if ($errors->has('signature'))
            <div class="invalid-feedback">
                 <strong>{{ $errors->first('signature') }}</strong>
            </div>
        @else
            <small id="signatureHelp" class="form-text text-muted">Enter your signed message. <a href="https://youtu.be/AvPdaNb35qY" target="_blank"><i class="fa fa-external-link"></i> Tutorial</a> </small>
        @endif
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Update
        </button>
    </div>
</form>