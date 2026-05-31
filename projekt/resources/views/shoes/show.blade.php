@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('styles/produkt.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<header class="header">
    <div class="logo">
        <img src="{{ asset('img/logo.png') }}" alt="logo strony">
    </div>

    <h1 class="tytul">BUTY.PL</h1>

    <div class="prawo">
        <a href="{{ route('cart.index') }}">
            <img class="koszyk" src="{{ asset('img/basketicon.png') }}" alt="koszyk">
        </a>

        <img class="usericon" src="{{ asset('img/usericon.png') }}" alt="ikona użytkownika">

        <div class="usermenu" id="usermenu">
            <a href="{{ route('login') }}">ZALOGUJ SIĘ</a>
            <a href="{{ route('register') }}">ZAREJESTRUJ SIĘ</a>
        </div>
    </div>
</header>

<main class="container">
    <section class="product">
        <div class="product__image">
            @if($shoe->image)
                <img
                    src="{{ asset('storage/' . $shoe->image) }}"
                    alt="{{ $shoe->name }}"
                    style="max-width: 100%; height: auto; border-radius: 8px;"
                >
            @else
                <div>Brak zdjęcia</div>
            @endif
        </div>

        <div class="product__info">
            <h2 class="product__title">{{ $shoe->name }}</h2>

            <p class="product__brand">{{ $shoe->brand }}</p>

            @if($shoe->category)
                <span class="badge bg-secondary me-2">{{ $shoe->category }}</span>
            @endif

            @if($shoe->type)
                <span class="badge bg-secondary">{{ $shoe->type }}</span>
            @endif

            <div class="product__rating">★★★★★</div>

            <div class="product__price">
                {{ number_format($shoe->price, 2, ',', ' ') }} PLN
            </div>

            <div class="product__sizes" style="margin: 15px 0;">
                <strong>Rozmiar:</strong> {{ $shoe->size ?? 'brak danych' }}
            </div>

            <form action="{{ route('cart.add', $shoe) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="d-flex gap-2">
                        <input
                            type="number"
                            name="quantity"
                            value="1"
                            min="1"
                            class="form-control"
                            style="width: 90px;"
                            required
                        >

                        <button class="btn btn-success">Dodaj do koszyka</button>
                    </div>
                </form>

            <div style="margin-top: 15px;">
                <a href="{{ route('cart.index') }}">Przejdź do koszyka</a>
            </div>

            <div class="product__delivery" style="margin-top: 20px;">
                <p>Dostawa: InPost 2.99 zł</p>
                <p>Zwrot: 14 dni</p>
            </div>
        </div>
    </section>

    <section class="accordion">
        <details>
            <summary>Informacje o produkcie</summary>
            <p>{{ $shoe->description ?? 'Brak opisu produktu.' }}</p>
        </details>

        <details>
            <summary>Opinie</summary>
            <p>Brak opinii</p>
        </details>
    </section>
</main>
@endsection