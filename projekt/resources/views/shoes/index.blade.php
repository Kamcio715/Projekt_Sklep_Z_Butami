@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKLEP Z BUTAMI</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <section class="hero">
        <div class="heroleft">
            <h1>„Buty oryginalne, żadne podróbki, szybka dostawa i dobre ceny 5/5"</h1>
            <h1> - CEO, Andrzej Mikołajczow</h1>
        </div>
        <div class="heroimg">
            <img src="{{ asset('storage/zdj/hero.png') }}" alt="but">
        </div>
    </section>
    <div class="search" id="search">
        <input type="text" placeholder="Szukaj..." id="searchinput" />
    </div>
    <div class="filtr">
        <h1 id="filtrbtn">FILTR</h1>
    </div>
    <div id="filtrpanel" class="filtrpanel">
        <div>
            <img src="img/logo.png" alt="logo strony">
        </div>
        <hr>
        <div class="filtrgrupa">
            <div class="sort">
                <h1>SORTUJ</h1>
                <select id="sortPrice">
                    <option value="">--</option>
                    <option value="asc">Najtańsze</option>
                    <option value="desc">Najdroższe</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="filtrgrupa">
            <h1>MARKA</h1>
            <select id="marka" name="marka">
                <option value=""></option>
                @foreach($brands as $brand)
                    <option value="{{ $brand }}" {{ request('marka') === $brand ? 'selected' : '' }}>
                        {{ $brand }}
                    </option>
                @endforeach
            </select>
        </div>
            <hr>
        <div class="filtrgrupa">
            <h1>KATEGORIA</h1>
            <select id="kat" name="kat">
                <option value=""></option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ request('kat') === $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                @endforeach
            </select>
        </div>
            <hr>
        <div class="filtrgrupa">
            <h1>RODZAJ</h1>
            <select id="rodz" name="rodz">
                <option value=""></option>
                @foreach($types as $type)
                    <option value="{{ $type }}" {{ request('rodz') === $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
        </div>
        <hr>
        <div class="filtrgrupa">
            <h1>ROZMIAR</h1>
            <select id="rozmiar" name="size">
                <option value="">Wszystkie</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
                <option value="32">32</option>
                <option value="38">38</option>
                <option value="39">39</option>
                <option value="40">40</option>
                <option value="41">41</option>
                <option value="42">42</option>
            </select>
        </div>
        <hr>
        <div class="filtrgrupa">
            <h1>CENA</h1>
            <input type="number" id="min" placeholder="Min" min="0">
            <input type="number" id="max" placeholder="Max" min="0">
        </div>
        <hr>
        <div class="filtrgrupa">
            <button id="reset">RESETUJ FILTRY</button>
        </div>
    </div>
    <section class="container" id="buty">
        @if($shoes->count())
            <ul class="grid">
                @foreach($shoes as $shoe)
                    <li class="card">
                        <a href="{{ route('shoes.show', $shoe) }}">
                            @if($shoe->image)
                                <img src="{{ asset('storage/' . $shoe->image) }}" alt="{{ $shoe->name }}">
                            @else
                                <div class="no-image">Brak zdjęcia</div>
                            @endif
                            <h4 class="nazwa">{{ $shoe->name }}</h4>
                            <hr>
                            <div class="p">{{ $shoe->brand }}</div>
                            <div class="cena">{{ number_format($shoe->price, 2, '.', '') }} zł</div>
                            <div>{{ $shoe->category }}</div>
                            <div>{{ $shoe->type }}</div>
                            <div>{{ is_array($shoe->size) ? implode(', ', $shoe->size) : $shoe->size }}</div>
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
</body>
</html>
@endsection