@include('pages.partials.buy.card', ['url' => config('bitcorn.wufoo')])
<h2 class="display-4 my-5">
    Delivery Info
</h2>
<div class="card mb-4">
    <div class="card-header">
        Important Information
    </div>
    <div class="card-body">
        <p class="card-text">
            <strong>All digital goods are delivered via the Bitcoin blockchain.</strong>
            A Counterparty-enabled wallet, like <a href="{{ config('bitcorn.counterwallet') }}" target="_blank">Counterwallet</a>, is required.
        </p>
        <p class="card-text">
            <strong>All orders are subject to cancellation.</strong>
            We reserve the right to cancel and refund your order, for any reason, if we choose.
        </p>
        <p class="card-text">
            <strong>All orders are processed manually.</strong>
            Please allow up to 5-10 business days before inquiring about the status of your order.
        </p>
    </div>
</div>
<h2 class="display-4 mt-5 mb-5">
    Access F.A.Q.
</h2>
<div class="card mb-4">
    <div class="card-header">
        Frequently Asked Questions
    </div>
    <div class="card-body">
        <p class="card-text">
            <strong>Why are there different access levels?</strong>
        </p>
        <p class="card-text">
            Primarily, CROPS is an access token. Without it, you are not playing the Bitcorns.com game. The number of crops at a given farm determines how much BITCORN it will yield at <a href="{{ route('harvests.index') }}">harvest time</a> and how much space it takes up on the World Map. Unrelated to gameplay itself, requiring a minimum amount of crops to access certain features, like the ability to upload images or the ability to create a group, helps mitigate against spam and abuse of the website.
        <p>
        <p class="card-text">
            <strong>Which access level should I choose?</strong>
        </p>
        <p class="card-text">
            Both levels of access we offer for sale on Bitcorns.com are geared towards casual players with an interest in the community aspects of the game. If you want to customize your farm art, choose Upload Access. Otherwise, choose Basic Access, for a smaller farm and standard farm image. The difference in size between the two access levels is 0.001 CROPS vs 0.01 CROPS.
        </p>
        <p class="card-text">
            <strong>What is the minimum level of access?</strong>
        </p>
        <p class="card-text">
            It's worth noting that any Bitcoin address with a non-zero balance of crops is, by definition, a bitcorn farm. So, it's possible to establish a farm as small as 0.00000001 CROPS. However, you would not be able to update that farm's basic information and it would not yield any bitcorn due to its size. 0.00003810 CROPS is the smallest a farm can be and still yield bitcorn, so it is also the minimum CROPS required to access basic features.
        </p>
        <p class="card-text">
            <strong>Can I purchase less than 0.001 CROPS?</strong>
        </p>
        <p class="card-text">
            Yes, but not from Bitcorns.com. It is not feasible for us to sell small amounts of CROPS, using Stripe, due to fees. You may find that there are other players willing to trade, sell, or gift small amounts to new players in our <a href="{{ config('bitcorn.telegram') }}" target="_blank">community chat room</a>.
        </p>
    </div>
</div>