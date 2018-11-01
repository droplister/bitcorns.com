<h2 class="display-4 my-5" style="white-space: nowrap;">
    <img src="{{ asset('/images/tokens/CROPS.png') }}" alt="CROPS access token" class="float-left mr-3 d-none d-sm-inline" width="60" />
    Buy CROPS
    <small class="lead d-none d-sm-inline">
        Establish a Farm
    </small>
</h2>
<div class="card-deck mb-3 text-center">
    <div class="card mb-5 box-shadow">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">Basic Access</h4>
        </div>
        <div class="card-body">
            <h1 class="card-title pricing-card-title">$3.50</h1>
            <ul class="list-unstyled mt-3 mb-3">
                <li>0.001 CROPS</li>
            </ul>
            <p class="card-text mb-4">
                Receive an amount of CROPS sufficient to establish a Bitcorns.com farm and gain access to basic features, like updating farm names, locations, and descriptions.
            </p>
            <a href="{{ route('pages.buy') }}" class="btn btn-lg btn-block btn-primary">
                <i class="fa fa-info-circle"></i>
                More Info
            </a>
        </div>
    </div>
    <div class="card mb-5 box-shadow">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">Upload Access</h4>
        </div>
        <div class="card-body">
            <h1 class="card-title pricing-card-title">$29.99</h1>
            <ul class="list-unstyled mt-3 mb-3">
                <li>0.01 CROPS</li>
            </ul>
            <p class="card-text mb-4">
                Receive an amount of CROPS sufficient to establish a Bitcorns.com farm and gain access to basic features, in addition to the ability to upload custom farm art.
            </p>
            <a href="{{ route('pages.buy') }}" class="btn btn-lg btn-block btn-primary">
                <i class="fa fa-info-circle"></i>
                More Info
            </a>
        </div>
    </div>
    <div class="card mb-5 box-shadow">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">XCP DEX</h4>
        </div>
        <div class="card-body">
            <h1 class="card-title pricing-card-title">{{ $last_price }}</h1>
            <ul class="list-unstyled mt-3 mb-3">
                <li>1 CROPS</li>
            </ul>
            <p class="card-text mb-4">
                Other amounts may be available on the Counterparty DEX or directly from other members of the community. The last trade on occurred at a strike price of {{ $last_price }}.
            </p>
            <a href="{{ config('bitcorn.xcpdex') }}" class="btn btn-lg btn-block btn-primary" target="_blank">
                <i class="fa fa-info-circle"></i>
                More Info
            </a>
        </div>
    </div>
</div>