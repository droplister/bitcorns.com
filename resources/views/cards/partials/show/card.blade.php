<div class="row mt-5">
    <div class="col-md-4 mb-4">
        @if(isset($card->meta_data['orientation']) && $card->meta_data['orientation'] === 'portrait')
            @include('cards.partials.show.modal')
            <img src="{{ $card->image_url }}" alt="{{ $card->name }}" width="100%" style="max-width: 375px" role="button" data-toggle="modal" data-target="#imageModal" style="cursor: pointer" />
        @else
            <img src="{{ $card->image_url }}" alt="{{ $card->name }}" width="100%" style="max-width: 375px" />
        @endif
        @if(isset($card->meta_data['hd_image_url']))
            @include('cards.partials.show.modal-hd')
            <div class="mt-3 text-center">
                <img src="{{ asset('images/3d-glasses.png') }}" alt="Dan's Vision" width="200" role="button" data-toggle="modal" data-target="#imageModalLarge" style="cursor: pointer" />
            </div>
        @endif
    </div>
    <div class="col-md-8">
        @include('cards.partials.show.head')
        <div class="card my-4">
            <div class="card-header">
                Harvest #{{ $card->harvest_id }} / Card #{{ $card->meta_data['overall_ranking'] }}
            </div>
            <div class="card-body">
                <p class="card-text">{{ $card->content }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Last Price
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            @if($last_match)
                                <a href="https://digirare.com/cards/{{ $card->slug }}" target="_blank">{{ $asset->divisible ? $last_match->trading_price_normalized : number_format($last_match->trading_price_normalized) }} {{ $last_match->trading_pair_quote_asset }}</a>
                            @else
                                <a href="https://digirare.com/cards/{{ $card->slug }}" target="_blank">No Trades</a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Supply
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $asset ? number_format($asset->supply_normalized) : __('Syncing') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>