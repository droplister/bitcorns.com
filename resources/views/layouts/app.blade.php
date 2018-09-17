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