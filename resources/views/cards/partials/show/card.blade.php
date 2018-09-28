<div class="row mt-5">
    <div class="col-md-4 mb-4">
        <img src="{{ $card->image_url }}" alt="{{ $card->name }}" width="100%" style="max-width: 375px;" />
    </div>
    <div class="col-md-8 mb-4">
        @include('cards.partials.show.head')
        <div class="card my-4">
            <div class="card-header">
                Description
            </div>
            <div class="card-body">
                <p class="card-text">{{ $card->content }}</p>
            </div>
        </div>
        <div class="row">
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
            <div class="col-sm-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Harvest
                    </div>
                    <div class="card-body">
                        <p class="card-text">#{{ $card->harvest_id }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Card
                    </div>
                    <div class="card-body">
                        <p class="card-text">#{{ $card->meta_data['overall_ranking'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>