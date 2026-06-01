@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<title>Koszyk</title>

<h1 class="mb-4 h1">Koszyk</h1>

    @if(session('success'))
        <div class="alert-overlay">
            <div class="custom-alert success">
                <h3>Sukces</h3>
                <p>{{ session('success') }}</p>
                <button onclick="this.closest('.alert-overlay').remove()">OK</button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert-overlay">
            <div class="custom-alert error">
                <h3>Błąd</h3>
                <p>{{ session('error') }}</p>
                <button onclick="this.closest('.alert-overlay').remove()">OK</button>
            </div>
        </div>
    @endif

    @if(empty($cart))
        <div class="alert alert-info empty-cart">
            <h2>Koszyk jest pusty</h2>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Produkt</th>
                        <th>Marka</th>
                        <th>Rozmiar</th>
                        <th>Rodzaj</th>
                        <th>Cena</th>
                        <th>Ilość</th>
                        <th>Razem</th>
                        <th>Akcja</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['brand'] ?? '-' }}</td>
                            <td>{{ $item['size'] ?? '-' }}</td>
                            <td>{{ $item['type'] ?? '-' }}</td>
                            <td>{{ number_format($item['price'], 2, ',', ' ') }} zł</td>
                            <td>
                                <form action="{{ route('cart.update', $item['cart_key']) }}" method="POST" class="quantity-form">
                                    @csrf
                                    <input
                                        type="number"
                                        name="quantity"
                                        value="{{ $item['quantity'] }}"
                                        min="1"
                                        max="{{ $item['stock'] }}"
                                        class="form-control quantity-input"
                                        required
                                    >
                                    <button type="submit" class="btn btn-primary btn-sm">Zmień</button>
                                </form>
                            </td>
                            <td>{{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} zł</td>
                            <td>
                                <form action="{{ route('cart.remove', $item['cart_key']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="cart-bottom">
            <div class="cart-summary">
                <h2>Razem: {{ number_format($total, 2, ',', ' ') }} zł</h2>

                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        Wyczyść koszyk
                    </button>
                </form>

                <a href="{{ route('checkout.index') }}" class="btn btn-success">
                    Przejdź do zamówienia
                </a>
            </div>
        </div>
    @endif
@endsection