<form role="form" method="POST" action="{{ route('farms.update', ['farm' => $farm->slug]) }}">
    @method('PUT')
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ? old('name') : $farm->name }}">
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                 <strong>{{ $errors->first('name') }}</strong>
            </div>
        @endif
    </div>
    <div class="form-group">
        <label for="content">Description</label>
        <input id="content" type="text" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" value="{{ old('content') ? old('content') : $farm->content }}">
        @if ($errors->has('content'))
            <div class="invalid-feedback">
                 <strong>{{ $errors->first('content') }}</strong>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <label for="latitude">Latitude</label>
            <input id="latitude" type="text" class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}" name="latitude" value="{{ old('latitude') ? old('latitude') : $farm->mapMarker->latitude }}">
            @if ($errors->has('latitude'))
                <div class="invalid-feedback">
                     <strong>{{ $errors->first('latitude') }}</strong>
                </div>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <label for="longitude">Longitude</label>
            <input id="longitude" type="text" class="form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}" name="longitude" value="{{ old('longitude') ? old('longitude') : $farm->mapMarker->longitude }}">
            @if ($errors->has('longitude'))
                <div class="invalid-feedback">
                     <strong>{{ $errors->first('longitude') }}</strong>
                </div>
            @endif
        </div>
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