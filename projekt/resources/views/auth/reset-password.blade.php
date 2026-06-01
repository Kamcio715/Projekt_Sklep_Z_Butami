@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<div class="min-h-screen">
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <h2 style="margin-bottom: 20px; text-align: center;">Ustaw nowe hasło</h2>

        <label for="email">E-mail</label>
        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus>

        @error('email')
            <div class="text-red-600">{{ $message }}</div>
        @enderror

        <label for="password">Nowe hasło</label>
        <input id="password" type="password" name="password" required>

        @error('password')
            <div class="text-red-600">{{ $message }}</div>
        @enderror

        <label for="password_confirmation">Powtórz hasło</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>

        @error('password_confirmation')
            <div class="text-red-600">{{ $message }}</div>
        @enderror

        <button type="submit">Zresetuj hasło</button>
    </form>
</div>
@endsection