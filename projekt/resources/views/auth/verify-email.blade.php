@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<div class="min-h-screen">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <h2 style="margin-bottom: 10px; text-align: center;">Weryfikacja e-mail</h2>
        <p style="margin-bottom: 20px; text-align: center; font-size: 14px;">
            Dziękujemy za rejestrację. Kliknij link weryfikacyjny wysłany na e-mail.
            Jeśli wiadomość nie dotarła, możesz wysłać ją ponownie.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div style="color: green; font-size: 13px; margin-bottom: 15px;">
                Wysłaliśmy nowy link weryfikacyjny na Twój adres e-mail.
            </div>
        @endif

        <button type="submit">Wyślij link ponownie</button>
    </form>
</div>
@endsection