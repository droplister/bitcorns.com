<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@yield('meta')

    <!-- Title Tags -->
    <title>@yield('title') &ndash; Bitcorn Crops</title>
    <meta name="description" content="@yield('description')">

    <!-- Stylesheets -->
    <link href="{{ asset('favicon.ico') }}" rel="icon">
    <link href="{{ asset('css/app.css?new') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js?new') }}" defer></script>

    <!--
     /$$       /$$   /$$                                            
    | $$      |__/  | $$                                            
    | $$$$$$$  /$$ /$$$$$$    /$$$$$$$  /$$$$$$   /$$$$$$  /$$$$$$$ 
    | $$__  $$| $$|_  $$_/   /$$_____/ /$$__  $$ /$$__  $$| $$__  $$
    | $$  \ $$| $$  | $$    | $$      | $$  \ $$| $$  \__/| $$  \ $$
    | $$  | $$| $$  | $$ /$$| $$      | $$  | $$| $$      | $$  | $$
    | $$$$$$$/| $$  |  $$$$/|  $$$$$$$|  $$$$$$/| $$      | $$  | $$
    |_______/ |__/   \___/   \_______/ \______/ |__/      |__/  |__/
    -->
</head>
<body>
    <div id="app">
        <header>
            <div class="collapse bg-dark" id="navbarHeader">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-8 py-4">
                            <h4 class="text-white">Bitcorn Crops</h4>
                            <p class="text-muted">Bitcorns is an idle game of accumulation, similar to AdVenture Capitalist, where the only objective is to accumulate BITCORN. BITCORN cannot be bought, rather, it gets harvested by bitcoin addresses ("farms") proportionate to their share of 100 CROPS. Deceptively simple, accumulating BITCORN takes an amount of CROPS most people do not possess.</p>
                        </div>
                        <div class="col-sm-4 py-4 d-none d-sm-inline">
                            <h4 class="text-white">Contact</h4>
                            <ul class="list-unstyled">
                                <li><a href="{{ config('bitcorn.telegram') }}" class="text-white" target="_blank">Telegram</a></li>
                                <li><a href="{{ config('bitcorn.twitter') }}" class="text-white" target="_blank">Twitter</a></li>
                                <li><a href="mailto:{{ config('bitcorn.email') }}" class="text-white">E-mail</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar navbar-dark navbar-expand bg-dark">
                <div class="container-fluid d-flex justify-content-between">
                    <a href="{{ url('/') }}" class="navbar-brand">
                        &#x1f33d; <span class="d-none d-lg-inline">Bitcorn</span>
                    </a>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('farms.index') }}">Farms</a>
                            </li>
                            <li class="nav-item d-none d-sm-inline">
                                <a class="nav-link" href="{{ route('coops.index') }}">Coops</a>
                            </li>
                            <li class="nav-item d-none d-sm-inline">
                                <a class="nav-link" href="{{ route('harvests.index') }}">Harvests</a>
                            </li>
                            <li class="nav-item d-none d-sm-inline">
                                <a class="nav-link" href="{{ route('pages.rules') }}">Rules</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cards.index') }}">Cards</a>
                            </li>
                            <li class="nav-item d-none d-sm-inline">
                                <a class="nav-link" href="{{ route('tokens.index') }}">Tokens</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="almanac_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                <div class="dropdown-menu" aria-labelledby="almanac_dropdown">
                                    <a class="dropdown-item d-inline-block d-sm-none" href="{{ route('coops.index') }}">Coops</a>
                                    <a class="dropdown-item d-inline-block d-sm-none" href="{{ route('tokens.index') }}">Tokens</a>
                                    <a class="dropdown-item d-inline-block d-sm-none" href="{{ route('harvests.index') }}">Harvests</a>
                                    <a class="dropdown-item" href="{{ route('achievements.index') }}">Achievements</a>
                                    <a class="dropdown-itemd-inline-block d-sm-none" href="{{ route('pages.rules') }}">Game Rules</a>
                                    <a class="dropdown-item" href="{{ route('cards.create') }}">Submit Card</a>
                                    <a class="dropdown-item" href="{{ config('bitcorn.medium') }}" target="_blank">Bitcorn Blog</a>
                                    <a class="dropdown-item" href="{{ config('bitcorn.store') }}" target="_blank">Memorabilia</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <form action="{{ route('farms.index') }}" method="GET" class="form-inline my-2 my-lg-0 d-none d-md-inline">
                        <input class="form-control mr-sm-2" name="q" type="search" placeholder="Search" aria-label="Search">
                    </form>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
        </header>
        <main role="main">
            @yield('content')
        </main>
        <footer class="text-muted">
            <div class="container">
                <p class="float-right d-none d-sm-inline">
                    <a href="#">Top ^</a>
                </p>
                <p>
                    <a href="mailto:{{ config('bitcorn.email') }}" class="mr-3">Contact</a>
                    <a href="{{ config('bitcorn.github') }}" target="_blank" class="mr-3">Github</a>
                    <a href="{{ route('pages.privacy') }}" class="mr-3">Privacy</a>
                    <a href="{{ route('pages.terms') }}" class="mr-3">Terms</a>
                    <a href="{{ route('pages.api') }}">API</a>
                </p>
            </div>
        </footer>
    </div>

<script async src="https://www.googletagmanager.com/gtag/js?id={{ config('bitcorn.analytics') }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '{{ config('bitcorn.analytics') }}');
</script>
</body>
</html>