@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<div class="min-h-screen">
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <h2 style="margin-bottom: 10px; text-align: center;">Potwierdź hasło</h2>
        <p style="margin-bottom: 20px; text-align: center; font-size: 14px;">
            Ze względów bezpieczeństwa wpisz swoje hasło ponownie.
        </p>

        <label for="password">Hasło</label>
        <input id="password" type="password" name="password" required autofocus>

        @error('password')
            <div class="text-red-600">{{ $message }}</div>
        @enderror

        <button type="submit">Potwierdź</button>
    </form>
</div>
@endsection