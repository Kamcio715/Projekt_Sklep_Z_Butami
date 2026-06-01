@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label style="color:black;" for="name" value="Imię i nazwisko" />
            <x-text-input
                id="name"
                class="block mt-1 w-full"
                type="text"
                name="name"
                placeholder="Wpisz imię i nazwisko"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label style="color:black;" for="email" value="Adres e-mail" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                placeholder="Wpisz adres e-mail"
                :value="old('email')"
                required
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label style="color:black;" for="address" value="Adres zamieszkania" />
            <x-text-input
                id="address"
                class="block mt-1 w-full"
                type="text"
                name="address"
                placeholder="Wpisz adres zamieszkania"
                :value="old('address')"
                required
                autocomplete="street-address"
            />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label style="color:black;" for="phone" value="Numer telefonu" />
            <x-text-input
                id="phone"
                class="block mt-1 w-full"
                type="text"
                name="phone"
                placeholder="Wpisz numer telefonu"
                :value="old('phone')"
                required
                autocomplete="tel"
            />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label style="color:black;" for="password" value="Hasło" />
            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                placeholder="Wpisz hasło"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label style="color:black;" for="password_confirmation" value="Powtórz hasło" />
            <x-text-input
                id="password_confirmation"
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                placeholder="Powtórz hasło"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none"
                href="{{ route('login') }}"
            >
                Masz już konto?
            </a>

            <x-primary-button class="ms-4">
                Zarejestruj się
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
@endsection