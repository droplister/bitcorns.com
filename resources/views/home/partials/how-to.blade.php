<h2 class="display-4 my-5">
    How to Play
</h2>
<div class="card">
    <div class="card-header">
        Overview
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4 col-lg-3">
                <img loading="lazy" src="{{ asset('/images/tiles/LAMBOGARAGE.png') }}" alt="LAMBOGARAGE" width="100%" />
            </div>
            <div class="col-sm-8 col-lg-9">
                <p class="card-text">
                    The object of the <strong>BITCORN CROPS</strong> game is to become the wealthiest player through harvesting and collecting <a href="{{ route('tokens.show', ['token' => 'BITCORN']) }}">BITCORN</a>. The player who collects the most bitcorn at the end of the game wins.
                </p>
                <p class="card-text">
                    By owning <a href="{{ route('tokens.show', ['token' => 'CROPS']) }}">CROPS</a>, players establish their Bitcoin addresses as <a href="{{ route('farms.index') }}">farms</a> on Bitcorns.com. With a farm, players can <a href="{{ route('harvests.index') }}">harvest crops</a> for a bitcorn reward.
                </p>
                <p class="card-text">
                    Between harvests, players can customize their farm's look, location, and <a href="{{ route('cards.index') }}">in-game assets</a>, immersing themselves in the <a href="#">Bitcorn world</a>. It's even possible to <a href="{{ route('coops.index') }}">join forces</a>!
                </p>
                <p class="cart-text">
                    <a href="{{ route('pages.rules') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-list"></i>
                        Game Rules
                    </a>
                    <a href="{{ config('bitcorn.wiki') }}" class="btn btn-sm btn-outline-primary" target="_blank">
                        <i class="fa fa-github"></i>
                        Game Wiki
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>