@extends('layouts.app')
@section('content')
<!-- <!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKLEP Z BUTAMI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body> -->
    <section class="hero">
        <div class="heroleft">
            <h1>„BARDZO DOBRE SUPER BUTY PAPUESZ POLAK POLECA 5/5"</h1>
            <h1> - GRAŻYNA ŻARKO</h1>
            <button class="herobtn">ZGARNIJ TERAZ</button>
        </div>
        <div class="heroimg">
            <img src="{{ asset('storage/zdj/hero.png') }}" alt="but">
        </div>
    </section>
    <div class="search" id="search">
        <input type="text" placeholder="Szukaj..." id="searchinput" />
    </div>
    <div class="filtr">
        <img id="filtricon" src="{{ asset('storage/zdj/filtricon.png') }}" alt="filtricon">
        <h1 id="filtrbtn">FILTR</h1>
    </div>
    <div id="filtrpanel" class="filtrpanel">
        <div>
            <img src="img/logo.png" alt="logo strony">
        </div>
        <hr>
        <div class="filtrgrupa">
            <h1>MARKA</h1>
            <select id="marka">
                <option></option>
                @foreach($brands as $brand)
                    <option value="{{ $brand -> brand }}" {{ request('brand') == $brand -> brand ? 'selected' : '' }}>
                        {{ $brand -> brand }} ({{ $brand -> total }})
                    </option>
                @endforeach
            </select>
        </div>
        <hr>
            <div class="filtrgrupa">
            <h1>KATEGORIA</h1>
            <select id="kat">
                <option></option>
                @foreach($categories as $category)
                    <option value="{{ $category -> category }}" {{ request('category') == $category -> category ? 'selected' : '' }}>
                        {{ $category -> category }} ({{ $category -> total }})
                    </option>
                @endforeach
            </select>
        </div>
        <hr>
        <div class="filtrgrupa">
            <h1>RODZAJ</h1>
            <select id="rodz">
                <option></option>
                @foreach($types as $type)
                    <option value="{{ $type -> type }}" {{ request('type') == $type -> type ? 'selected' : '' }}>
                        {{ $type -> type }} ({{ $type -> total }})
                    </option>
                @endforeach
            </select>
        </div>
        <hr>
    </div>
    <section class="container">
        @if($shoes->count())
            <ul class="grid">
                @foreach($shoes as $shoe)
                    <li class="card">
                        <a href="{{ route('shoes.show', $shoe) }}">
                            @if($shoe->zdjecie)
                                <img src="{{ asset('storage/' . $shoe->zdjecie) }}" alt="{{ $shoe->name }}">
                            @else
                                <div class="no-image">Brak zdjęcia</div>
                            @endif
                            <h4>{{ $shoe->nazwa }}</h4>
                            <hr>
                            <div>{{ $shoe->marka }}</div>
                            <div>{{ number_format($shoe->cena, 2, '.', '') }} zł</div>
                            <div>{{ $shoe->kategoria }}</div>
                            <div>{{ $shoe->rodzaj }}</div>
                            <div>{{ $shoe->rozmiar }}</div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="brak">
                Brak produktów spełniających wybrane kryteria.
            </div>
        @endif
    </section>
    <footer class="footer">
        <div class="footercontainer">
            <p class="footertitle">POMOC</p>
            <hr>
            <div class="footerlink">
                <a href="">Skontaktuj się z nami</a>
                <a href="">Polityka prywatności</a>
                <a href="">Regulamin</a>
            </div>
            <p class="footertm">Buty.pl™. Wszelkie prawa zastrzeżone</p>
        </div>
    </footer>
@endsection