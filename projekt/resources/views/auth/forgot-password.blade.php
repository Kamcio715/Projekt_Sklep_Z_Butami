@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<div class="min-h-screen">
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <h2 style="margin-bottom: 10px; text-align: center;">Przypomnienie hasła</h2>
        <p style="margin-bottom: 20px; text-align: center; font-size: 14px;">
            Podaj swój adres e-mail, a wyślemy Ci link do resetu hasła.
        </p>

        @if (session('status'))
            <div style="color: green; font-size: 13px; margin-bottom: 15px;">
                {{ session('status') }}
            </div>
        @endif

        <label for="email">E-mail</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

        @error('email')
            <div class="text-red-600">{{ $message }}</div>
        @enderror

        <button type="submit">Wyślij link resetujący</button>
    </form>
</div>
@endsection