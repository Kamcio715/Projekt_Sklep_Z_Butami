@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKLEP Z BUTAMI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <section class="hero">
        <div class="heroleft">
            <h1>„BARDZO DOBRE SUPER BUTY PAPUESZ POLAK POLECA 5/5"</h1>
            <h1> - GRAŻYNA ŻARKO</h1>
            <button class="herobtn">ZGARNIJ TERAZ</button>
        </div>
        <div class="heroimg">
            <img src="{{ asset('storage/zdj/Carina2.0_07.jpg') }}" alt="but">
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
         <ul class="grid">
            <li class="card">
                <img src="img/nike1.png" alt="nike1">
                <h2>Nike1</h2>
                <hr>
                <p>Dla mężczyzn</p>
                <p>Sportowe</p>
                <p>Cena 29.99zł</p>
            </li>
        </ul>
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
            <p class="footertm">Buty.pl™. Wszelkie prawa zastrzeżone. Spierdalaj</p>
        </div>
    </footer>
</body>
</html>
@endsection