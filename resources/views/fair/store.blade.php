@extends('layouts.app')

@section('title', 'Looks Fair')

@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card text-center">
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
                                    <input id="farm_1" type="text" class="form-control" value="{{ $farm_1->slug }}" disabled>
                                </div>
                                <table class="table mb-0 text-left" style="overflow-y: auto; white-space: nowrap;">
                                    <thead>
                                        <tr>
                                            <th scope="col">Card</th>
                                            <th scope="col">Balance</th>
                                            <th scope="col">Issuance</th>
                                            <th scope="col">Harvest</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($list_1 as $card)
                                            <tr>
                                                <td><a href="{{ route('card.show', ['card' => $card->token->slug]) }}">{{ $card->token->name }}</a></td>
                                                <td>{{ $card->quantity }}</td>
                                                <td>{{ $card->token->asset->issuance }}</td>
                                                <td>{{ $card->token->harvest_id }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center">
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
                                    <input id="farm_2" type="text" class="form-control" value="{{ $farm_2->slug }}" disabled>
                                </div>
                                <table class="table mb-0 text-left" style="overflow-y: auto; white-space: nowrap;">
                                    <thead>
                                        <tr>
                                            <th scope="col">Card</th>
                                            <th scope="col">Balance</th>
                                            <th scope="col">Issuance</th>
                                            <th scope="col">Harvest</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($list_2 as $card)
                                            <tr>
                                                <td><a href="{{ route('card.show', ['card' => $card->token->slug]) }}">{{ $card->token->name }}</a></td>
                                                <td>{{ $card->quantity }}</td>
                                                <td>{{ $card->token->asset->issuance }}</td>
                                                <td>{{ $card->token->harvest_id }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection