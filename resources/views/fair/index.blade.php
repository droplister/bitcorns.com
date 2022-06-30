@extends('layouts.app')

@section('title', 'Fair Trade')

@section('content')
<div class="content">
    <div class="container">
        <form role="form" method="POST" action="{{ route('fair.store') }}">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="farm1Tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="farm-1-tab" data-toggle="tab" href="#farm-1" role="tab" aria-controls="farm-1" aria-selected="true">
                                        Farm 1
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="farm1TabContent">
                                <div class="tab-pane fade show active" id="farm-1" role="tabpanel" aria-labelledby="farm-1-tab">
                                    <div class="form-group">
                                        <input id="farm_1" type="text" class="form-control{{ $errors->has('farm_1') ? ' is-invalid' : '' }}" name="farm_1" required>
                                        @if ($errors->has('farm_1'))
                                            <div class="invalid-feedback">
                                                 <strong>{{ $errors->first('farm_1') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dupes_1" id="dupes_1" checked>

                                        <label class="form-check-label" for="dupes_1">
                                            {{ __('Dupes Only') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="farm2Tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="farm-2-tab" data-toggle="tab" href="#farm-2" role="tab" aria-controls="farm-2" aria-selected="true">
                                        Farm 2
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="farm2TabContent">
                                <div class="tab-pane fade show active" id="farm-2" role="tabpanel" aria-labelledby="farm-2-tab">
                                    <div class="form-group">
                                        <input id="farm_2" type="text" class="form-control{{ $errors->has('farm_2') ? ' is-invalid' : '' }}" name="farm_2" required>
                                        @if ($errors->has('farm_2'))
                                            <div class="invalid-feedback">
                                                 <strong>{{ $errors->first('farm_2') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dupes_2" id="dupes_2" checked>

                                        <label class="form-check-label" for="dupes_2">
                                            {{ __('Dupes Only') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Compare Farms
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection