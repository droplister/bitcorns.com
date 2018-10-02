<div class="row mt-5">
    <div class="col-md-4 mb-4">
        <img src="{{ $card->image_url }}" alt="{{ $card->name }}" width="100%" style="max-width: 375px;" />
        @if(isset($card->meta_data['hd_image_url']))
            @include('cards.partials.show.modal')
            <div class="mt-3 text-center">
                <img src="{{ asset('images/3d-glasses.png') }}" alt="Dan's Vision" width="200" role="button" data-toggle="modal" data-target="#imageModal" style="cursor: pointer;" />
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
                            <a href="https://digirare.com/cards/{{ $card->slug }}" target="_blank">{{ $last_match ? $last_match->trading_price_normalized . ' ' . $last_match->trading_pair_quote_asset : __('No Trades') }}</a>
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
<div class="row mb-4">
    <div class="col-12 col-sm-6">
        @include('cards.partials.show.coop', ['coop' => $top_coop])
    </div>
    <div class="col-12 col-sm-6">
        @include('cards.partials.show.farm', ['farm' => $top_farm])
    </div>
</div>