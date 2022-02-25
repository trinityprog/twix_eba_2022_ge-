<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="url" content="{{ url('/') }}">
        <meta name="format-detection" content="telephone=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="inputmask" content="{{ blink()->mask() }}">

        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />

        <title>@lang('index.head.title') | {{ env('APP_NAME') }}</title>

        <meta name="description" content="@lang('index.head.description') | {{ env('APP_NAME') }}">
        <meta name="keywords" content="snickers, twix, bounty, mars">

        <!-- Fav.Start -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
        <link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#2d89ef">
        <meta name="theme-color" content="#ffffff">
        <!-- Fav.End -->

        <!-- OG.Start -->
        <meta property="og:title" content="ТWIX. Двойное удовольствие.">
        <meta property="og:url" content="{{ url('/') }}"/>
        <meta property="og:description" content="Выигрывай призы для себя." />
        <meta property="og:asset" content="{{ asset('/') }}" />
        <meta property="og:image" content="{{ asset('i/og.jpg') }}" />
        <!-- OG.End -->

        <link rel="stylesheet" href="{{ mix('css/style.css') }}">
        @livewireStyles

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-JVFRWCYZ3B"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-JVFRWCYZ3B');
        </script>

        <!-- Global site tag (gtag.js) - Google Ads: 765865962 -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-765865962"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'AW-765865962');
        </script>

        <!-- Event snippet for Регистрация Twixpromo conversion page -->
        <script>
            gtag('event', 'conversion', {'send_to': 'AW-765865962/psmqCOHlgKADEOrfmO0C'});
        </script>
    </head>
    <body class="@yield('class', null)">
        @yield('header')

        @yield('content')

        @yield('footer')

        @yield('modals')

        <script type="text/javascript" src="{{ mix('js/script.js') }}"></script>

        @livewireScripts

        @yield('scripts')
    </body>
</html>
