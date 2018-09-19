<div class="card mb-4">
    <div class="card-header">
        Card Submissions are <strong>OPEN</strong>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('images/blank-card-example.png') }}" alt="Blank Card Example" width="100%" />
                <h5 class="card-title mt-4">
                    Creative Assets
                </h5>
                <p class="card-text">
                    <strong class="d-block">PSD &amp; Fonts:</strong>
                    <a href="{{ asset('assets/BitcornCardTemplatePSDfonts.zip') }}">BitcornCardTemplatePSDfonts.zip</a>
                </p>
                <p class="card-text">
                    <strong class="d-block">Border-Only:</strong>
                    <a href="{{ asset('assets/BitcornCardTemplateBorderOnly.psd') }}">BitcornCardTemplateBorderOnly.psd</a>
                </p>
            </div>
            <div class="col-md-8">
                <h5 class="card-title">
                    How to Start
                </h5>
                <p class="card-text">
                    Start by creating a unique Bitcorn card that you think is creative, funny, or otherwise well-suited for our blockchain farming game. Browse the <a href="{{ route('cards.index') }}">card directory</a> for inspiration and examples. Be YOU-nique!
                </p>
                <p class="card-text">
                    We provide two templates, one that looks like a <a href="{{ asset('assets/BitcornCardTemplatePSDfonts.zip') }}">trading card</a> and one that is <a href="{{ asset('assets/BitcornCardTemplateBorderOnly.psd') }}">just a border</a>. For the sake of Bitcorn cards becoming distinctive and easily recognized, our border is required.
                </p>
                <p class="card-text">
                    Once you have your card art, <a href="https://hackernoon.com/how-to-create-a-token-using-counterparty-xcp-357b2890e744" target="_blank">create a Counterparty asset</a> to represent it on the blockchain. You can issue as many copies of your card as you like, most artists prefer smaller runs.
                </p>
                <h5 class="card-title">
                    Submissions
                </h5>
                <p class="card-text">
                    When you're ready to submit, it's time to <em>burn</em>. First, send {{ config('bitcorn.subfee') }} {{ config('bitcorn.reward_token') }} to our submission fee burn address. Next, send one of your new card to our <a href="https://bitcornmuseum.org/" target="_blank">Bitcorn Museum</a> for permanent display.
                </p>
                <p class="card-text">
                    After, you can use the form on this page to submit your card. If it is accepted (not guaranteed) it will become a Bitcorn Card and get integrated into the game.
                </p>
                <h5 class="card-title">
                    Submission Fee
                </h5>
                <p class="card-text">
                    Send {{ config('bitcorn.subfee') }} BITCORN to this address: <a href="https://xchain.io/address/{{ config('bitcorn.subfee_address') }}" target="_blank">{{ config('bitcorn.subfee_address') }}</a>.
                </p>
                <p class="card-text">
                    <em>The average card sells for {{ $dex_average }} {{ config('bitcorn.reward_token') }} on the Counterparty DEX.</em>
                </p>
                <h5 class="card-title">
                    Bitcorn Museum
                </h5>
                <p class="card-text">
                    Send one (1) of your cards here: <a href="https://xchain.io/address/{{ config('bitcorn.museum_address') }}" target="_blank">{{ config('bitcorn.museum_address') }}</a>.
                </p>
                <p class="card-text">
                    <em>It's important that we curate and save this art forever.</em>
                </p>
                <h5 class="card-title">
                    Requirements
                </h5>
                <ol class="pl-3">
                    <li>Image must be 375 x 520 pixels.</li>
                    <li>Image must be PNG or GIF.</li>
                    <li>Issuance must be LOCKED.</li>
                    <li>Asset must not be divisible.</li>
                    <li>No subassets.</li>
                    <li>No NSFW content.</li>
                    <li>No "pre-selling" before approval.</li>
                </ol>
                <p class="card-text">
                    <a href="{{ config('bitcorn.telegram') }}" class="btn btn-primary" target="_blank">
                        <i class="fa fa-telegram"></i> Questions? Join Our Chat!
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>