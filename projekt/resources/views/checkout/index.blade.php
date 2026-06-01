<link rel="stylesheet" href="{{ asset('css/summary.css') }}">
@extends('layouts.app')

@section('content')
<div class="checkout-page">
    <h1 class="mb-4">Finalizacja zamówienia</h1>

    <ul class="list-group mb-4">
        @foreach($cart as $item)
            <li class="list-group-item d-flex justify-content-between">
                <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                <span>{{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} zł</span>
            </li>
        @endforeach
        <li class="list-group-item d-flex justify-content-between">
            <strong>Razem</strong>
            <strong>{{ number_format($total, 2, ',', ' ') }} zł</strong>
        </li>
    </ul>

    <form action="{{ route('checkout.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Imię i nazwisko</label>
            <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="customer_email" class="form-control" value="{{ old('customer_email') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Telefon</label>
            <input type="text" name="customer_phone" class="form-control" value="{{ old('customer_phone') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Adres</label>
            <textarea name="address" class="form-control" rows="3">{{ old('address') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="delivery_method" class="form-label">Metoda dostawy</label>
            <select name="delivery_method" id="delivery_method" class="form-select" required>
                <option value="">Wybierz dostawę</option>
                <option value="kurier">Kurier</option>
                <option value="paczkomat">Paczkomat</option>
                <option value="odbior_osobisty">Odbiór osobisty</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="payment_method" class="form-label">Metoda płatności</label>
            <select name="payment_method" id="payment_method" class="form-select" required>
                <option value="">Wybierz płatność</option>
                <option value="blik">BLIK</option>
                <option value="karta">Karta</option>
                <option value="przy_odbiorze">Płatność przy odbiorze</option>
            </select>
        </div>


        <button class="btn btn-success">Złóż zamówienie</button>
    </form>
</div>
@endsection