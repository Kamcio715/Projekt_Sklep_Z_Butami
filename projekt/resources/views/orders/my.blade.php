
<link rel="stylesheet" href="{{ asset('css/orders.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
@extends('layouts.app')

@section('content')
<div class="orders-page">
    <h1 class="mb-4">Moje zamówienia</h1>

    @if($orders->count() === 0)
        <h1>Nie masz jeszcze żadnych zamówień.</h1>
    @else
            <table class="table table-bordered bg-white">
                <thead>
                    <tr>
                        <th>Nr zamówienia</th>
                        <th>Data</th>
                        <th>Kwota</th>
                        <th>E-mail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td data-label="Nr zamówienia">#{{ $order->id }}</td>
                            <td data-label="Data">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                            <td data-label="Kwota">{{ number_format($order->total, 2, ',', ' ') }} zł</td>
                            <td data-label="E-mail">{{ $order->customer_email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        {{ $orders->links() }}
    @endif
</div>
@endsection