<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/filtrowanie.js') }}"></script>
    <script src="{{ asset('js/panele.js') }}"></script>
    <script src="{{ asset('js/sort-price.js') }}"></script>
    


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href=" {{ route('shoes.index') }} "><img src="{{ asset('storage/zdj/logo.png') }}" alt="logo strony"></a>
        </div>
        <a href="{{ route('shoes.index') }}"><h1 class="tytul">BUTY.PL</h1></a>
        <div class="prawo">
            <img id="searchlogo" src="storage/zdj/lupa.png" alt="searchlogo">
            <a href="{{ route('cart.index') }}"><img class="koszyk" src="{{ asset('storage/zdj/basketicon.png') }}" alt="koszyk"></a>
            <img class="usericon" src="{{ asset('storage/zdj/usericon.png') }}" alt="ikona użytkownika">
            <div class="usermenu" id="usermenu">
                @auth
                    <a href="{{ route('profile.edit') }}">Profil</a>
                    <a class="" href="{{ route('orders.my') }}">Moje zamówienia</a>

                    @if(auth()->user()->isAdmin())
                        <a class="" href="{{ route('admin.shoes.index') }}">Panel admina</a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="">
                        @csrf
                        <button class="">Wyloguj</button>
                    </form>
                @else
                    <a class="" href="{{ route('login') }}">Logowanie</a>
                    <a class="" href="{{ route('register') }}">Rejestracja</a>
                @endauth
            </div>
        </div>
    </header>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        

        <!-- Page Content -->
        <main>
            <div class="app-container">

            @yield('content')
            </div>
        </main>

    </div>
    <footer class="footer">
        <div class="footercontainer">
            <p class="footertitle">POMOC</p>
            <hr>
            <div class="footerlink">
                <a href="">Skontaktuj się z nami</a>
                <a href="">Polityka prywatności</a>
                <a href="">Regulamin</a>
            </div>
            <p class="footertm">Buty.pl™. Wszelkie prawa zastrzeżone.</p>
        </div>
    </footer>
    </body>
</html>