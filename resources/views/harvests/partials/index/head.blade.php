<forecast></forecast>
<a href="{{ route('pages.calculator') }}" class="btn btn-outline-success float-right mt-3 mr-3 d-none d-md-inline-block">
    <i class="fa fa-calculator"></i> Calculator
</a>
<h1 class="display-4 my-5">
    <span class="d-none d-sm-inline">Bitcorn</span> Harvests
    <small class="lead d-none d-sm-inline">{{ $harvests->count() }} Total</small>
</h1>