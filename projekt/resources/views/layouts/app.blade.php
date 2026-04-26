<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <script src="{{ asset('js/filtrowanie.js') }}"></script>


        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
    </head>
    <body class="font-sans antialiased">
        <header class="header">
            <div class="logo">
                <img src="{{ asset('storage/zdj/logo.png') }} alt="logo strony">
            </div>
            <h1 class="tytul">BUTY.PL</h1>
            <div class="prawo">
                <img id="searchlogo" src="storage/zdj/lupa.png" alt="searchlogo">
                <a href="{{ route('cart.index') }}"><img class="koszyk" src="storage/zdj/koszyk.png" alt="koszyk"></a>
                <img class="usericon" src="{{ asset('storage/zdj/user.png') }}" alt="ikona użytkownika">
                <div class="usermenu" id="usermenu">
                    <a href="{{ route('login') }}">ZALOGUJ SIĘ</a>
                    <a href="{{ route('register') }}">ZAREJESTRUJ SIĘ</a>
                </div>
            </div>
        </header>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            

            <!-- Page Content -->
            <main>
                <div class="app-container">
                @if(session('success'))
                    <div class="alert alert-success mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
                </div>
            </main>
    </body>
</html>