@extends('layouts.app')
@section('content')
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
                <option value="Nike">Nike</option>
                <option value="Adidas">Adidas</option>
                <option value="Puma">Puma</option>
                <option value="Champion">Champion</option>
                <option value="Vans">Vans</option>
            </select>
        </div>
        <hr>
            <div class="filtrgrupa">
            <h1>KATEGORIA</h1>
            <select id="kat">
                <option></option>
                <option value="mężczyzn">Dla mężczyzn</option>
                <option value="kobiet">Dla kobiet</option>
                <option value="dzieci">Dla dzieci</option>
            </select>
        </div>
        <hr>
        <div class="filtrgrupa">
            <h1>RODZAJ</h1>
            <select id="rodz">
                <option></option>
                <option value="Sportowe">Sportowe</option>
                <option value="Eleganckie">Eleganckie</option>
                <option value="Codzienne">Codzienne</option>
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
                            @if($shoe->image)
                                <img src="{{ asset('storage/' . $shoe->image) }}" alt="{{ $shoe->name }}">
                            @else
                                <div class="no-image">Brak zdjęcia</div>
                            @endif
                            <h4 class="nazwa">{{ $shoe->name }}</h4>
                            <hr>
                            <div class="p">{{ $shoe->brand }}</div>
                            <div>{{ number_format($shoe->price, 2, '.', '') }} zł</div>
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
@endsection