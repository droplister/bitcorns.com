@if(Auth::guard('player')->guest() || Auth::guard('player')->check() && Auth::guard('player')->user()->group_id !== $group->id)
@if('open' === $group->type)
<form role="form" method="POST" action="{{ route('memberships.store', ['group' => $group->slug]) }}">
    {{ csrf_field() }}
    @if(Auth::guard('player')->check())
    <input id="address" type="hidden" name="address" value="{{ Auth::guard('player')->user()->address }}">
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Join Co-Op
        </button>
    </div>
    @else
    <div class="form-group">
        <label for="address">Member</label>
        <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" placeholder="19QWXpMXeLkoEKEJv2xo9rn8wkPCyxACSX">
        @if ($errors->has('address'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('address') }}</strong>
        </div>
        @else
        <small id="memberHelp" class="form-text text-muted">Enter your address. You can only have one membership.</small>
        @endif
    </div>
    <hr class="mb-4" />
    <div class="form-group">
        <label for="timestamp">Timestamp</label>
        <input id="timestamp" type="text" class="form-control{{ $errors->has('timestamp') ? ' is-invalid' : '' }}" name="timestamp" value="{{ old('timestamp') ? old('timestamp') : \Carbon\Carbon::now() }}" required>
        @if ($errors->has('timestamp'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('timestamp') }}</strong>
        </div>
        @else
        <small id="timestampHelp" class="form-text text-muted">Sign this timestamp to authorize update.</small>
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
        <small id="signatureHelp" class="form-text text-muted">Enter your signed timestamp message. <a href="https://youtu.be/AvPdaNb35qY" target="_blank"><i class="fa fa-external-link"></i> Tutorial</a> </small>
        @endif
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Save
        </button>
    </div>
    @endif
</form>
@else
<p class="card-text"><em>This is a closed group and requires an invitation to join.</em></p>
@endif
@endif