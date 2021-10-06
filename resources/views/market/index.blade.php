@extends('layouts.app')

@section('title', 'Farmer\'s Market')

@section('content')
<div class="container">
	<h1 class="display-4 my-5">
	    <span class="d-none d-sm-inline">Farmer's</span> Market
	</h1>
	<div class="row">
	    <div class="col">
	        <div class="card">
	            <div class="card-header">
	                <ul class="nav nav-tabs card-header-tabs" id="achievementsTabContent" role="tablist">
	                    <li class="nav-item">
	                        <a class="nav-link active" id="dispenser-tab" data-toggle="tab" href="#dispenser" role="tab" aria-controls="dispenser" aria-selected="true">
	                            Dispensers <span class="badge badge-dark">{{ $dispensers->count() }}</span>
	                        </a>
	                    </li>
	                    <li class="nav-item">
	                        <a class="nav-link" id="dispense-tab" data-toggle="tab" href="#dispense" role="tab" aria-controls="dispense" aria-selected="true">
	                            Dispenses <span class="badge badge-dark">{{ $dispenses->count() }}</span>
	                        </a>
	                    </li>
	                </ul>
	            </div>
	            <div class="card-body">
	                <div class="tab-content" id="achievementsTabContent">
	                    <div class="tab-pane fade show active" id="dispenser" role="tabpanel" aria-labelledby="dispenser-tab">
	                        <div class="table-responsive">
	                            <table class="table mb-0 text-left" style="overflow-y: auto; white-space: nowrap;">
	                                <thead>
	                                    <tr>
	                                        <th scope="col">For Sale</th>
	                                        <th scope="col">Quantity</th>
	                                        <th scope="col">BTC Rate</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                    @foreach($dispensers as $dispenser)
	                                        <tr>
	                                            <td><a href="https://xchain.io/tx/{{ $dispenser->tx_hash }}">{{ $dispenser->asset }}</a></td>
	                                            <td>{{ $dispenser->give_quantity_normalized }}</td>
	                                            <td>{{ $dispenser->trading_price_normalized }} BTC</td>
	                                        </tr>
	                                    @endforeach
	                                </tbody>
	                            </table>
	                        </div>
	                    </div>
	                    <div class="tab-pane fade" id="dispense" role="tabpanel" aria-labelledby="dispense-tab">
	                        <div class="table-responsive">
	                            <table class="table mb-0 text-left" style="overflow-y: auto; white-space: nowrap;">
	                                <thead>
	                                    <tr>
	                                        <th scope="col">Dispensed</th>
	                                        <th scope="col">Quantity</th>
	                                        <th scope="col">BTC Rate</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                    @foreach($dispenses as $dispense)
	                                        <tr>
	                                            <td><a href="https://xchain.io/tx/{{ $dispense->tx_hash }}">{{ $dispense->asset }}</a></td>
	                                            <td>{{ $dispense->dispense_quantity_normalized }}</td>
	                                            <td>{{ $dispense->dispenser->trading_price_normalized }} BTC</td>
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