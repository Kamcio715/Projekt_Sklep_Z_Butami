<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep z butami</title>
    <link rel="stylesheet" href="Styles/main.css">
    <link rel="stylesheet" href="Styles/naglowek.css">
    <script src="Scripts/filtrowanie.js"></script>
</head>
<body>
    
    <!-- Nagłówek -->
    <header class="gora">
        <div class="logo">
            <a class="lewo" href="index.html"><img src="Images/logo.png" alt="logo strony"></a>
        </div>
        <h1 class="tytul">Buty.pl</h1>
        <div class="prawo">
            <button class="rejestracja"><a href="rejestracja.html">Zarejestruj się</a></button>
            <button class="login"><a href="logowanie.html">Zaloguj się</a></button>
            <a href="koszyk.html"><img class="koszyk" src="Images/koszyk.png" alt="koszyk"></a>
            <a href="uzytkownik.html"><img class="user" src="Images/user.png" alt="ikona użytkownika"></a>
        </div>
    </header>
    
    <!-- Szukanie po nazwie -->
    <div class="szukaj">
        <input type="text" class="szukaj_input" id="filtr" placeholder="Wyszukaj swoich wymarzonych butów">
    </div>
    
    <!--szukanie po marce-->
    <h3>Wybierz markę</h3>
    <select id="marka">
        <option></option>
        <option value="Nike">Nike</option>
        <option value="Adidas">Adidas</option>
        <option value="Puma">Puma</option>
        <option value="Champion">Champion</option>
        <option value="Vans">Vans</option>
    </select>

    <!--szukanie po kategorii-->
    <h3>Wybierz kategorię</h3>
    <select id="kat">
        <option></option>
        <option value="mężczyzn">Dla mężczyzn</option>
        <option value="kobiet">Dla kobiet</option>
        <option value="dzieci">Dla dzieci</option>
    </select>

    <!--szukanie po rozdaju-->
    <h3>Wybierz Rodzaj</h3>
    <select id="rodz">
        <option></option>
        <option value="Sportowe">Sportowe</option>
        <option value="Eleganckie">Eleganckie</option>
        <option value="Codzienne">Codzienne</option>
    </select>

    <!--filtrowanie po cenie-->
    <h3>Wybierz cene</h3>
    <div class="cena-container">
        <div class="cena-input">
            <div class="przedział-cena">
                <span>Min.</span>
                <input type="number" class="min-input" value="69">
            </div>
            <div class="przedział-cena">
                <span>Max.</span>
                <input type="number" class="Max-input" value="23412">
            </div>
        </div>
        <div class="slider">
            <div class="div-slider"></div>
        </div>
        <!--slider--> <!--https://www.geeksforgeeks.org/javascript/price-range-slider-with-min-max-input-using-html-css-and-javascript/-->
        <div class="zakres-input">
            <input type="range" class="min-range" min="0" max="10000" value="3000" step="1">
            <input type="range" class="max-range" min="0" max="10000" value="6969" step="1">
        </div>  

    </div>
    <!-- Buty -->
    <div class="widok">
            <ul class="lista">
                <li>
                    <div>
                        <div>
                            <img src="images/Carina2.0_01.jpg" alt="but">
                        </div>
                        <div>
                            <h1 class="nazwa">CARINA 2.0</h1>
                            <h2>Puma</h2>
                            <h2>339.99 zł</h2>
                            <h3>Dla kobiet</h3>
                            <h3>Sportowe</h3>
                        </div>
                    </div>
                </li>
            </ul>
    </div>
        </footer>
    <script src="scripts/main.js"></script>
</body>
</html>
