<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buty.pl</title>
    <link rel="stylesheet" href="styles/produkt.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

    <header class="header">
        <div class="logo">
            <img src="img/logo.png" alt="logo strony">
        </div>
        <h1 class="tytul">BUTY.PL</h1>
        <div class="prawo">
            <a href="koszyk.html"><img class="koszyk" src="img/basketicon.png" alt="koszyk"></a>
            <img class="usericon" src="img/usericon.png" alt="ikona użytkownika">
            <div class="usermenu" id="usermenu">
                <a href="">ZALOGUJ SIĘ</a>
                <a href="">ZAREJESTRUJ SIĘ</a>
            </div>
        </div>
    </header>

<main class="container">

    <section class="product">

        <div class="product__image">
            @if($shoe->image)
                <img src="{{ asset('storage/' . $shoe->image) }}"
                    alt="{{ $shoe->name }}"
                    style="max-width: 100%; height: auto; border-radius: 8px;">
            @else
                <div>Brak zdjęcia</div>
            @endif
        </div>

        <div class="product__info">
            <h2 class="product__title">{{ $shoe -> name }}</h2>

            <p class="product__brand">{{ $shoe -> brand }}</p>
            @if($shoe->category)
                    <span class="badge bg-secondary me-2">{{ $shoe->category }}</span>
                @endif
                @if($shoe->type)
                    <span class="badge bg-secondary">{{ $shoe->type }}</span>
                @endif
            <div class="product__rating">★★★★★</div>

            <div class="product__colors">
                <label>
                    <input type="radio" name="color">
                    <img src="img/1krokslidlowy(1).png" alt="Kolor 1">
                </label>

                <label>
                    <input type="radio" name="color">
                    <img src="img/1krokslidlowy(1).png" alt="Kolor 2">
                </label>
            </div>

            <div class="product__price">{{ number_format($shoe->price, 2, ',', ' ') }} PLN</div>

            <div class="product__sizes">
                <label><input type="radio" name="size">36</label>
                <label><input type="radio" name="size">37</label>
                <label><input type="radio" name="size">38</label>
                <label><input type="radio" name="size">39</label>
            </div>

            <form action="{{ route('cart.add', $shoe) }}" method="POST">
                @csrf
                <button type="submit">Dodaj do koszyka</button>
            </form>

            <div class="product__delivery">
                <p>Dostawa: InPost 2.99 zł</p>
                <p>Zwrot: 14 dni</p>
            </div>

        </div>

    </section>

    <section class="accordion">
        <details>
            <summary>Informacje o produkcie</summary>
            <p>Opis produktu...</p>
        </details>

        <details>
            <summary>Opinie</summary>
            <p>Brak opinii</p>
        </details>
    </section>

    <section class="recommended">
        <h3>Polecane produkty</h3>

        <div class="recommended__grid">
            <div class="card">
                <img src="img/1krokslidlowy(1).png">
                <p>But 1</p>
                <span>29,99 zł</span>
            </div>
            <div class="card">
                <img src="img/1krokslidlowy(1).png">
                <p>But 1</p>
                <span>29,99 zł</span>
            </div>
            <div class="card">
                <img src="img/1krokslidlowy(1).png">
                <p>But 1</p>
                <span>29,99 zł</span>
            </div>
            <div class="card">
                <img src="img/1krokslidlowy(1).png">
                <p>But 1</p>
                <span>29,99 zł</span>
            </div>
        </div>
    </section>

</main>

<footer class="footer">
    <div class="footercontainer">
        <p class="footertitle">POMOC</p>
        <hr>
        <div class="footerlink">
            <a href="">Skontaktuj się z nami</a>
            <a href="">Polityka prywatności</a>
            <a href="">Regulamin</a>
        </div>
        <p class="footertm">Buty.pl™. Wszelkie prawa zastrzeżone. <!--spierdalaj--> &copy;</p>
    </div>
</footer>

</body>
</html>