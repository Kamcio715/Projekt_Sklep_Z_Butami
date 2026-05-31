
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Koszyk</title>
    <h1 class="mb-4 h1">Koszyk</h1>

    <!-- @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif -->

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(empty($cart))
        <div class="alert alert-info">
            Koszyk jest pusty.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Produkt</th>
                        <th>Marka</th>
                        <th>Rozmiar</th>
                        <th>Opis</th>
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
                            <td>{{ $item['description'] ?? '-' }}</td>
                            <td>{{ $item['type'] ?? '-' }}</td>
                            <td>{{ number_format($item['price'], 2, ',', ' ') }} zł</td>
                            <td>
                                <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="d-flex gap-2 justify-content-center">
                                    @csrf
                                    <input
                                        type="number"
                                        name="quantity"
                                        value="{{ $item['quantity'] }}"
                                        min="1"
                                        class="form-control quantity-input"
                                        required
                                    >
                                    <button type="submit" class="btn btn-primary btn-sm">Zmień</button>
                                </form>
                            </td>
                            <td>{{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} zł</td>
                            <td>
                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
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