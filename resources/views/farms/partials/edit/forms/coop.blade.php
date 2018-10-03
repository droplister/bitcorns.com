@if($farm->coop)
    <form role="form" method="POST" action="{{ route('farms.update', ['farm' => $farm->slug]) }}">
        @method('DELETE')
        @csrf
        <div class="form-group">
            <label for="name">Member of:</label>
            <select class="form-control" disabled> 
                <option>{{ $farm->coop->name }}</option>
            </select>
            @if($errors->has('name'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </div>
            @endif
        </div>
        <div class="form-check">
            <input type="checkbox" name="leave" id="leave" required>
            <label for="leave">Please remove me from this coop.</label>
            @if($errors->has('leave'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('leave') }}</strong>
                </div>
            @endif
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
@else
    <p>
        <a href="{{ route('coops.index') }}">Join a cooperative</a> or <a href="{{ route('coops.create') }}">start your own</a>!
    </p>
@endif