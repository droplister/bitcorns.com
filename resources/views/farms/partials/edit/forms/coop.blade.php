<form role="form" method="POST" action="{{ route('farms.coop.update', ['farm' => $farm->slug]) }}">
    @method('PUT')
    @csrf
    <div class="form-group">
        <label for="name">Cooperative:</label>
        <select id="coop" class="form-control" name="coop">
            <option>Select a Coop:</option>
            @foreach($coops as $coop)
                <option value="{{ $coop->id }}"{{ $farm->coop_id === $coop->id ? ' selected' : '' }}>{{ $coop->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-check">
        <input type="checkbox" name="add" id="add">
        <label for="add">Add me to this coop.</label>
    </div>
    <div class="form-check">
        <input type="checkbox" name="leave" id="leave">
        <label for="leave">Remove me from this coop.</label>
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
            <i class="fa fa-save"></i> Update
        </button>
    </div>
</form>