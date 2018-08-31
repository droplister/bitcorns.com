<div class="row">
    <div class="col-md-3">
        <div class="mb-4">
            <img src="{{ $card->image_url }}" width="100%" style="max-width: 375px;" />
        </div>
    </div>
    <div class="col-md-9">
        <div class="card mb-4">
            <div class="card-header">
                Description
            </div>
            <div class="card-body">
                <p class="card-text">{{ $card->content }}</p> 
                <div class="row">
                    <div class="col-4 col-sm-3 col-lg-2">
                        <i class="fa fa-{{ $card->asset->divisible ? 'check text-success' : 'times text-danger' }}"></i> Divisible
                    </div>
                    <div class="col-4 col-sm-3 col-lg-2">
                        <i class="fa fa-{{ $card->asset->locked ? 'check text-success' : 'times text-danger' }}"></i> Locked
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Supply
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $card->asset->supply_normalized }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Holders
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $balances->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>