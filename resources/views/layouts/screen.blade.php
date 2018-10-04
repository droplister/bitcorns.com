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
        <main role="main">
            @yield('content')
        </main>
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