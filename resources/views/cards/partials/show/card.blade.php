<div class="row mt-5">
    <div class="col-md-4 mb-5 text-center">
        @include('cards.partials.show.modal')
        <img loading="lazy" src="{{ $card->image_url }}" alt="{{ $card->name }}" width="100%" style="max-width: 375px; cursor: pointer;" role="button" data-toggle="modal" data-target="#imageModal" />
        @if(isset($card->meta_data['hd_image_url']))
            @include('cards.partials.show.modal-hd')
            <div class="mt-3 text-center">
                <img loading="lazy" src="{{ asset('images/3d-glasses.png') }}" alt="Dan's Vision" width="200" role="button" data-toggle="modal" data-target="#imageModalLarge" style="cursor: pointer" />
            </div>
        @endif
    </div>
    <div class="col-md-8">
        @include('cards.partials.show.head')
        <div class="card my-4">
            <div class="card-header">
                Harvest #{{ $card->harvest_id }} / Card #{{ isset($card->meta_data['overall_ranking']) ? $card->meta_data['overall_ranking'] : '???' }}
            </div>
            <div class="card-body">
                <p class="card-text">{{ $card->content }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card mb-5">
                    <div class="card-header">
                        Last Price
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            @if($card->lastMatch() && $card->lastDispense())
                                @if($card->lastMatch()->confirmed_at > $card->lastDispense()->confirmed_at)
                                    <a href="https://xchain.io/tx/{{ $card->lastMatch()->tx1_index }}" target="_blank">{{ number_format($card->lastMatch()->trading_price_normalized, 8) }} {{ $card->lastMatch()->trading_pair_quote_asset }}</a>
                                @else
                                    <a href="https://xchain.io/tx/{{ $card->lastDispense()->tx_index }}" target="_blank">{{ number_format($card->lastDispense()->dispenser->trading_price_normalized, 8) }} BTC</a>
                                @endif
                            @elseif($card->lastMatch())
                                <a href="https://xchain.io/tx/{{ $card->lastMatch()->tx1_index }}" target="_blank">{{ number_format($card->lastMatch()->trading_price_normalized, 8) }} {{ $card->lastMatch()->trading_pair_quote_asset }}</a>
                            @elseif($card->lastDispense())
                                <a href="https://xchain.io/tx/{{ $card->lastDispense()->tx_index }}" target="_blank">{{ number_format($card->lastDispense()->dispenser->trading_price_normalized, 8) }} BTC</a>
                            @else
                                <a href="https://digirare.com/cards/{{ $card->slug }}" target="_blank">No Trades</a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card mb-5">
                    <div class="card-header">
                        Issuance
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $card->asset ? number_format($card->asset->supply_normalized) : __('Syncing') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>