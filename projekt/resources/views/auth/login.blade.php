<link rel="stylesheet" href="{{ asset('css/login.css') }}">

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

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="auth-page">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label style="color:black;" for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="e-mail" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label style="color:black;" for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="hasło" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label style="color:black;" for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ms-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
<footer class="footer">
    <div class="footercontainer">
        <p class="footertitle">POMOC</p>
        <hr>
        <div class="footerlink">
            <a href="">Skontaktuj się z nami</a>
            <a href="">Polityka prywatności</a>
            <a href="">Regulamin</a>
        </div>
        <p class="footertm">Buty.pl™. Wszelkie prawa zastrzeżone. Spierdalaj</p>
    </div>
</footer>