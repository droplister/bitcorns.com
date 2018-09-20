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
    <title>@yield('title') &ndash; {{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="@yield('description')">

    <!-- Stylesheets -->
    <link href="{{ asset('favicon.ico') }}" rel="icon">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

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
                            <p class="text-muted">Bitcorns is an idle game of accumulation, similar to AdVenture Capitalist, where the only objective is to accumulate BITCORN. BITCORN cannot be bought, rather, it gets harvested by bitcoin addresses ("farms") proportionate to their share of 100 CROPS. Deceptively simple, accumulating BITCORN takes an amount of restraint most people do not possess.</p>
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
                        &#x1f33d; <span class="d-none d-lg-inline">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>
            </div>
        </header>

        <main role="main">
            @yield('content')
        </main>
    </div>
</body>
</html>