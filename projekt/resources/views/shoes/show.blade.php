@extends('layouts.app')

@section('content')
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    font-family: "Roboto Condensed", sans-serif;
    background: #fff;
    color: #111;
}
html, body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
}
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0px 60px;
    background-color: black;
    position: relative;
    width: 100%;
    z-index: 1000;
    height: 10vh;
    min-height: 78px;
}
.header a {
    text-decoration: none;
    color: rgb(255, 255, 255);
}
.logo img{
    height: 83px;
    box-sizing: border-box;
}
.logo{
    height: auto;
}
.tytul {
    font-size: 45px;
    font-weight: 900;
    letter-spacing: 2px;
}
.prawo {
    display: flex;
    align-items: center;
    gap: 15px;
}
.usericon, #searchlogo, .prawo a img{
    height: 40px;
    width: 40px;
    cursor: pointer;
}
#searchlogo{
    display: none;
}
.usermenu {
    position: absolute;
    right: 0;
    background: rgb(0, 0, 0);
    color: rgb(255, 255, 255);
    border-radius: 0px 0px 10px 10px;
    padding: 10px 0;
    width: 160px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    transform: translateY(-300px);
    transition: .6s;
    z-index: 1;
    position: absolute;
    top: 100%;
    opacity: 0;
    transform: translateY(-20px);
    pointer-events: none;
    transition: all .3s ease;
    text-align: center;
}

.usermenu a {
    font-size: 1.1em;
    display: block;
    padding: 10px 15px;
    text-decoration: none;
    color: rgb(255, 255, 255);
    transition: 0.3s;
}
.usermenu a:nth-child(3){
    color: red;
}
.usermenu a:nth-child(3):hover{
    color: rgb(100, 0, 0);
}
.usermenu button{
    font-size: 1.1em;
    background-color: black;
    color: white;
    border: none;
    text-align: center;
    margin: 10px 15px;
    font-family: "Roboto Condensed", sans-serif;
    transition: 0.3s;
}
.usermenu a:hover, .usermenu button:hover {
    cursor: pointer;
    color: #777;
}

.usermenu.active {
    opacity: 1;
    top: 10vh;
    transform: translateY(0);
    pointer-events: auto;
}
/* MAIN */
.container {
    max-width: 1200px;
    margin: auto;
    padding-top: 100px;
}

/* PRODUCT */
.product {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    padding: 20px;
}

.product__image img {
    width: 100%;
    border-radius: 10px;
    background: #f5f5f5;
}

.product__info {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.product__brand {
    color: #777;
    font-size: 12px;
}

.product__title {
    font-size: 26px;
}

.product__price {
    font-size: 24px;
    font-weight: bold;
}

/* COLORS */
.product__colors img {
    width: 50px;
    border-radius: 6px;
    cursor: pointer;
}

.product__colors input {
    display: none;
}

/* SIZES */
.product__sizes label {
    border: 1px solid #ccc;
    padding: 8px 12px;
    cursor: pointer;
    margin-right: 5px;
}

.product__sizes input {
    display: none;
}

.product__sizes input:checked + label {
    background: #000;
    color: #fff;
}
.product__delivery {
    margin-top: 15px;
    padding: 15px;
    border-radius: 10px;
    background: #f8f8f8;
    border: 1px solid #e0e0e0;
    font-size: 16px;
}

.product__delivery p {
    display: flex;
    justify-content: space-between;
    font-weight: 500;
    padding: 5px 0;
}

.product__delivery p:first-child {
    color: #2e7d32; /* zielony dla dostawy */
}

.product__delivery p:last-child {
    color: #1565c0; /* niebieski dla zwrotu */
}
.form-control {
    width: 70px !important;
    height: 45px;
    border: 2px solid #ddd;
    border-radius: 8px;
    text-align: center;
    font-size: 18px;
    font-weight: 600;
    background: white;
    transition: 0.2s;
}

.form-control:hover {
    border-color: #000;
}

.form-control:focus {
    outline: none;
    border-color: #000;
    box-shadow: 0 0 0 4px rgba(0,0,0,0.08);
}

.form-control::-webkit-inner-spin-button,
.form-control::-webkit-outer-spin-button {
    opacity: 1;
}
/* BUTTON */
.btn-primary {
    font-family: "Roboto Condensed", sans-serif;
    margin-top: 15px;
    background: #000;
    color: #fff;
    width: 260px !important;
    height: 55px !important;
    padding: 14px 24px;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    cursor: pointer;
    transition: 0.25s;
}

.btn-primary:hover {
    background: #222;
    transform: translateY(-2px);
}

.btn-primary:active {
    transform: translateY(0);
}

/* RECOMMENDED */

.recommended {
    padding: 50px 20px;
}

.recommended h3 {
    font-size: 24px;
    margin-bottom: 20px;
}

.recommended__grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 20px;
}

.recommended__grid img {
    width: 100%;
    border-radius: 12px;
    background: #f5f5f5;
    padding: 10px;
    transition: all 0.3s ease;
    cursor: pointer;
}

/* HOVER */
.recommended__grid img:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
.card {
    background: #fff;
    border-radius: 12px;
    padding: 10px;
    text-align: center;
    transition: 0.3s;
    border: 1px solid #eee;
}

.card img {
    width: 100%;
    border-radius: 8px;
}

.card p {
    margin-top: 10px;
    font-weight: 600;
}

.card span {
    color: #000;
    font-weight: bold;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
.accordion {
    max-width: 800px;
    margin: 60px auto;
    padding: 0 20px;
}

.accordion details {
    background: #fafafa;
    border-radius: 10px;
    margin-bottom: 15px;
    padding: 20px;
    border: 1px solid #ddd;
    transition: all 0.3s ease;
}

.accordion details[open] {
    background: #fff;
    border-color: #000;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.accordion summary {
    font-size: 20px;
    font-weight: 700;
    cursor: pointer;
    list-style: none;
    position: relative;
}

/* usuwa default strzałkę */
.accordion summary::-webkit-details-marker {
    display: none;
}

/* własna strzałka */
.accordion summary::after {
    content: "+";
    position: absolute;
    right: 0;
    font-size: 22px;
    transition: 0.3s;
}

.accordion details[open] summary::after {
    content: "–";
}

/* zawartość */
.accordion p {
    margin-top: 15px;
    font-size: 16px;
    line-height: 1.6;
    color: #444;
}
.recenzje{
    grid-column: 1 / span 2;
    width: 100%;
    margin-top: 70px;
    padding: 60px 30px;
    background: #f6f6f6;
    border-radius: 25px;
}
.recenzje .mb-3{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:10px;
    flex-wrap:wrap;
}
.recenzje h2{
    font-size: 36px;
    font-weight: 900;
    margin-bottom: 10px;
    text-align: center;
}
.recenzje .container{
    max-width:100% !important;
    width:100% !important;
    padding:0;
}

.recenzje .row{
    margin:0;
}

.recenzje .col-md-12,
.recenzje .col-lg-10,
.recenzje .offset-lg-1{
    width:100% !important;
    max-width:100% !important;
    margin-left:0 !important;
}
.sliderTestimonialThird{
    display:grid;
    grid-template-columns: repeat(2, 1fr);
    gap:25px;
    margin-top:30px;
}

.sliderTestimonialThird .item{
    width:100%;
}

.sliderTestimonialThird .card{
    height:100%;
    padding:25px;
    border-radius:22px;
    background:white;
    border:1px solid #e5e5e5;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    transition:.3s;
    padding:20px 25px !important;
}

.sliderTestimonialThird .card:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 35px rgba(0,0,0,.14);
}

.sliderTestimonialThird .card-body{
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:12px;
}
.item{
    grid-column: 1 / span 2;
}
.avatar{
    width:75px;
    height:75px;
    border-radius:50%;
    border:4px solid black;
    object-fit:cover;
}

.sliderTestimonialThird p{
    font-size:17px;
    line-height:1.6;
    color:#333;
    max-width:420px;
}

.sliderTestimonialThird h3{
    font-size:22px;
    font-weight:900;
}

.sliderTestimonialThird span{
    font-size:14px;
    color:#555;
}
.card a,
.card a:visited {
    color: #000;
    text-decoration: none;
}

.card a:hover {
    color: #000;
    text-decoration: none;
}
.text-warning{
    color:#f5b301 !important;
}

.text-secondary{
    color:#ccc !important;
}
#dodaj-opinie h2{
    text-align: center;
}
#dodaj-opinie h4{
    font-size: 24px;
    font-weight: 900;
}
#dodaj-opinie .card{
    border-radius:22px;
    border:1px solid #ddd;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

#dodaj-opinie textarea{
    width:100% !important;
    min-height:130px;
    border-radius:14px;
    padding:15px;
    resize:none;
}

#dodaj-opinie button{
    width:auto !important;
    padding:12px 25px;
    border-radius:12px;
}
#dodaj-opinie{
    text-align:center;
    margin-top:25px;
}

#dodaj-opinie .offset-lg-1{
    display:flex;
    flex-direction:column;
    align-items:center;
}

#dodaj-opinie .btn-primary{
    margin:0 auto 12px auto;
    display:flex;
    align-items:center;
    justify-content:center;
}

.login-info{
    text-align:center;
    font-size:18px;
    margin:0 0 25px 0;
}

.recenzje .col-lg-6.col-md-4{
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
}
/* FOOTER */
.footer {
    background-color: black;
    color: #fff;
    padding: 40px 20px;
    min-height: 250px;
}
.footercontainer {
  max-width: 1200px;
  margin: 0 auto;
  text-align: center;
}
.footertitle {
  font-family: 'Oswald', Arial, sans-serif;
  font-size: 22px;
  letter-spacing: 3px;
}
.footerlink {
  margin-bottom: 20px;
}
.footercontainer hr{
    margin: 25px 0px;
}
.footerlink a {
  color: #ccc;
  text-decoration: none;
  margin: 0 15px;
  font-size: 16px;
  transition: color 0.3s;
}
.footerlink a:hover {
  color: #fff;
}
.footertm {
  font-size: 12px;
  color: #777;
}

/* MOBILE */
@media (max-width: 768px) {
    .header {
        padding: 10px;
        text-align: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        min-height: 50px;
    }
    .logo img{
        height: 45px;
    }
    .tytul {
        font-size: 30px;
    }
    .prawo img,.prawo a {
        height: 40px;
    }
    .recenzje h2{
        font-size:28px;
    }
}
@media (max-width: 480px){
    .tytul {
        font-size: 20px;
    }
    .prawo img,.prawo a {
        height: 32px;
    }
    .usericon, #searchlogo, .prawo a img {
        height: 32px;
        width: 32px;
    }
    .product {
        grid-template-columns: 1fr;
    }
    .recenzje{
        grid-column:1;
        padding:35px 15px;
    }

    .sliderTestimonialThird{
        grid-template-columns:1fr;
    }
    .footer {
        height: auto;
        padding: 20px 10px;
        text-align: center;
    }
    .footerlink a {
        display: block;
        margin: 8px 0;
    }
}

</style>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
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

            <div class="product__price">
                {{ number_format($shoe->price, 2, ',', ' ') }} PLN
            </div>
            <p>Stan magazynowy: {{ $shoe->stock }}</p>

            <div class="product__sizes" style="margin: 15px 0;">
                <label for="size"><strong>Rozmiar:</strong></label>
                <select
                    name="size"
                    id="size"
                    class="form-control @error('size') is-invalid @enderror"
                    form="add-to-cart-form"
                    required
                    style="max-width: 220px; margin-top: 8px;"
                >
                    <option value="" disabled selected>Wybierz rozmiar</option>

                    @if(is_array($shoe->size))
                        @foreach($shoe->size as $size)
                            <option value="{{ $size }}" @selected(old('size') == $size)>
                                {{ $size }}
                            </option>
                        @endforeach
                    @elseif(!empty($shoe->size))
                        <option value="{{ $shoe->size }}" selected>
                            {{ $shoe->size }}
                        </option>
                    @endif
                </select>

                @error('size')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <form action="{{ route('cart.add', $shoe) }}" method="POST" class="mt-3" id="add-to-cart-form">
                @csrf

                <div class="d-flex gap-2 align-items-center">
                    <input
                        type="number"
                        name="quantity"
                        value="{{ old('quantity', 1) }}"
                        min="1"
                        class="form-control @error('quantity') is-invalid @enderror"
                        style="width: 90px;"
                        required
                    >
                </div>

                @error('quantity')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror

                <div class="d-flex gap-2 align-items-center mt-3">
                    <button class="btn-primary" type="submit">Dodaj do koszyka</button>
                </div>
            </form>

            <div style="margin-top: 15px; color: black">
                <a style="color: black" href="{{ route('cart.index') }}">Przejdź do koszyka</a>
            </div>

        </div>
    </section>

    @if(isset($recommendedShoes) && $recommendedShoes->count())
        <section class="recommended mt-5">
            <h3 class="mb-4">Proponowane buty</h3>

            <div class="row g-4">
                @foreach($recommendedShoes as $recommended)
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 shadow-sm border-0">
                            @if($recommended->image)
                                <img src="{{ asset('storage/' . $recommended->image) }}"
                                     class="card-img-top"
                                     alt="{{ $recommended->name }}"
                                     style="height: 220px; object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light"
                                     style="height: 220px;">
                                    <span class="text-muted">Brak zdjęcia</span>
                                </div>
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $recommended->name }}</h5>
                                <p class="text-muted mb-2">{{ $recommended->brand }}</p>
                                <p class="fw-bold mb-3">{{ number_format($recommended->price, 2, ',', ' ') }} zł</p>

                                <a href="{{ route('shoes.show', $recommended) }}" class="btn btn-outline-dark mt-auto">
                                    Zobacz produkt
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
    <section class="bg-gray-200 pt-lg-14 pb-lg-16 pt-5 pb-8 mt-5 recenzje">
        <div class="container">
            <div class="row mb-lg-10 mb-5">
                <div class="offset-lg-1 col-lg-10 col-12">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-8">
                            <div>
                                <div class="mb-3">
                                    <span class="text-dark fw-semibold">
                                        {{ number_format($shoe->reviews->avg('rating') ?? 0, 1) }}/5.0
                                    </span>
                                    <!-- <span>
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="fs-6 align-top">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" class="bi bi-star-fill text-warning" viewBox="0 0 16 16">
                                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                </svg>
                                            </span>
                                        @endfor
                                    </span> -->
                                    <span class="ms-2">Na podstawie {{ $shoe->reviews->count() }} opinii</span>
                                </div>

                                <h2 class="mb-0">
                                    Poznaj opinie klientów o tym modelu butów.
                                </h2>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row mb-5" id="dodaj-opinie">
                <div class="offset-lg-1 col-lg-10 col-12">
                    @auth
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="mb-4">Dodaj swoją opinię</h4>

                                <form action="{{ route('reviews.store', $shoe) }}" method="POST">
                                    @csrf

                                    <div class="col-md-6">
                                        <div class="rating-card p-4">
                                            <div class="star-rating animated-stars">
                                                <input type="radio" id="star5" name="rating" value="5">
                                                <label for="star5" class="bi bi-star-fill"></label>
                                                <input type="radio" id="star4" name="rating" value="4">
                                                <label for="star4" class="bi bi-star-fill"></label>
                                                <input type="radio" id="star3" name="rating" value="3">
                                                <label for="star3" class="bi bi-star-fill"></label>
                                                <input type="radio" id="star2" name="rating" value="2">
                                                <label for="star2" class="bi bi-star-fill"></label>
                                                <input type="radio" id="star1" name="rating" value="1">
                                                <label for="star1" class="bi bi-star-fill"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <h4 for="content" class="form-label">Twoja opinia</h4>
                                        <textarea name="content" id="content" rows="4" class="form-control @error('content') is-invalid @enderror" placeholder="Napisz, co sądzisz o tych butach..." required>{{ old('content') }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Dodaj opinię</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            Zaloguj się
                        </a>

                        <p class="login-info">
                            Zaloguj się, aby dodać opinię.
                        </p>
                    @endauth
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="position-relative">
                        <div class="sliderTestimonialThird">
                            @forelse($shoe->reviews as $review)
                                <div class="item">
                                    <div class="card">
                                        <div class="card-body text-center p-6">

                                            <p class="mb-0 mt-3">{{ $review->content }}</p>

                                            <div class="lh-1 mb-3 mt-4">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <span class="fs-6 align-top">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" class="bi bi-star-fill {{ $i <= $review->rating ? 'text-warning' : 'text-secondary' }}" viewBox="0 0 16 16">
                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                        </svg>
                                                    </span>
                                                @endfor
                                                <span class="text-warning">{{ $review->rating }}/5</span>
                                            </div>

                                            <div>
                                                <h3 class="mb-0 h4">{{ $review->user->name ?? 'Użytkownik' }}</h3>
                                                <span>{{ $review->created_at->format('d.m.Y H:i') }}</span>
                                            </div>

                                            @auth
                                                @if(auth()->id() === $review->user_id)
                                                    <div class="mt-4 d-flex justify-content-center gap-2 flex-wrap">
                                                        <a href="{{ route('reviews.edit', $review) }}" class="btn btn-outline-primary btn-sm">
                                                            Edytuj
                                                        </a>

                                                        <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                                Usuń
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="item">
                                    <div class="card">
                                        <div class="card-body text-center p-6">
                                            <h3 class="mb-3 h4">Brak opinii</h3>
                                            <p class="mb-0">Ten produkt nie ma jeszcze opinii.</p>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection