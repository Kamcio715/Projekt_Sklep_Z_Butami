@extends('layouts.app')

@section('content')
<h1 class="">Moje zamówienia</h1>

@if($orders->count() === 0)
    <p>Nie masz jeszcze żadnych zamówień.</p>
@else
    <div class="">
        <table class="">
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
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ number_format($order->total_amount, 2, ',', ' ') }} zł</td>
                        <td>{{ $order->customer_email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $orders->links() }}
@endif
@endsection