<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('images/blank-card-example.png') }}" alt="Blank Card Example" width="100%" />
                <h5 class="card-title mt-4">
                    Creative Assets
                </h5>
                <p>
                    <strong class="d-block">PSD and Font:</strong>
                    <a href="{{ asset('assets/BitcornCardTemplatePSDfonts.zip') }}">BitcornCardTemplatePSDfonts.zip</a>
                </p>
                <p>
                    <strong class="d-block">Border-Only PSD:</strong>
                    <a href="{{ asset('assets/BitcornCardTemplateBorderOnly.psd') }}">BitcornCardTemplateBorderOnly.psd</a>
                </p>
            </div>
            <div class="col-md-8">
                <h5 class="card-title">
                    How it Works
                </h5>
                <p>Start by creating a unique Bitcorn card that you think is creative, funny, or otherwise well-suited for a blockchain farming game. Browse the <a href="{{ route('cards.index') }}">card directory</a> for inspiration and examples. Be YOU-nique!</p>
                <p>We provide two templates, one that looks like a card and one that is just its border. For the sake of cards being easily recognizable, the border is a minimum requirement.</p>
                <p>Once you have card art, <a href="https://hackernoon.com/how-to-create-a-token-using-counterparty-xcp-357b2890e744" target="_blank">create a Counterparty asset</a> to represent this card's supply on the blockchain. You can issue as many cards as you like, some artists prefer small runs.</p>
                <p>Next, it's time to <em>burn</em>. Send the {{ config('bitcorn.subfee') }} BITCORN submission fee is to our burn address and 1 of your tokens to our <a href="https://bitcornmuseum.org/" target="_blank">Bitcorn Museum</a> burn address for permanent display.</p>
                <p>Lastly, use the form on this page to submit your card. If it is accepted (not guaranteed) it will become a Bitcorn Card<sup>&trade;</sup> and be supported by our platform and others.</p>
                <h5 class="card-title">
                    Submission Fee
                </h5>
                <p>Send {{ config('bitcorn.subfee') }} BITCORN to this address: {{ config('bitcorn.subfee_address') }}.</p>
                <h5 class="card-title">
                    Bitcorn Museum
                </h5>
                <p>Send 1 of your cards here: {{ config('bitcorn.museum_address') }}.</p>
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
            </div>
        </div>
    </div>
</div>