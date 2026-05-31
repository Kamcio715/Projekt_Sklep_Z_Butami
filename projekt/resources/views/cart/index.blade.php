@extends('layouts.app')

@section('content')
    <title>Koszyk</title>
</head>
<body>

  <header>
    <h1>Koszyk</h1>
    <nav>
      <ul>
        <li><a href="#">Strona główna</a></li>
        <li><a href="koszyk.html">Koszyk</a></li>
        <li><a href=" {{ route('checkout.index') }} ">Podsumowanie</a></li>
      </ul>
    </nav>
    <hr>
  </header>

  <main>

    <h2>Produkty w koszyku</h2>

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
                                <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="d-flex gap-2">
                                    @csrf
                                    <input
                                        type="number"
                                        name="quantity"
                                        value="{{ $item['quantity'] }}"
                                        min="1"
                                        class="form-control"
                                        style="width: 90px;"
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

        <h2 class="mt-4">Razem: {{ number_format($total, 2, ',', ' ') }} zł</h2>

        <div class="mt-3 d-flex justify-content-end">
            <a href="{{ route('checkout.index') }}" class="btn btn-success">
                Przejdź do zamówienia
            </a>
        </div>
@endsection
