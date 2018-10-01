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
                <img src="{{ asset('/images/tiles/LAMBOGARAGE.png') }}" alt="LAMBOGARAGE" width="100%" />
            </div>
            <div class="col-sm-8 col-lg-9">
                <p class="card-text">
                    The object of the <strong>BITCORN CROPS</strong> game is to become the wealthiest player through harvesting and collecting <a href="{{ route('tokens.show', ['token' => 'BITCORN']) }}">BITCORN</a>. The player who collects the most bitcorn at the end of the game wins. (See: <a href="{{ route('pages.rules') }}#winning">Winning</a>.)
                </p>
                <p class="card-text">
                    By owning <a href="{{ route('tokens.show', ['token' => 'CROPS']) }}">CROPS</a>, players establish their Bitcoin addresses as <a href="{{ route('farms.index') }}">farms</a> on Bitcorns.com. With a farm, players can harvest crops for a bitcorn reward. (See: <a href="{{ route('harvests.index') }}">Harvests</a>.)
                </p>
                <p class="card-text">
                    Between harvests, players can customize their farm's look, location, and in-game assets, immersing themselves in the <a href="#">Bitcorn world</a>. It's even possible to join forces! (See: <a href="{{ route('coops.index') }}">Co-Ops</a>.)
                </p>
                <p class="cart-text">
                    <a href="{{ route('pages.rules') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-list"></i>
                        Full Rules
                    </a>
                    <a href="{{ config('bitcorn.telegram') }}" class="btn btn-sm btn-outline-primary" target="_blank">
                        <i class="fa fa-telegram"></i>
                        Telegram
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>