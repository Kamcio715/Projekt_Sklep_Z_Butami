<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class CheckoutController extends Controller
{
    // Wyświetlanie podsumowania zamówienia
    public function index()
    {
        $cart = session()->get('cart',[]);

        if (empty($cart)){
            return redirect()->route('cart.index')->with('success', 'Koszyk jest pusty.');
        }

        $total = 0;
        foreach($cart as $item){
             $total += $item['price'] * $item['quantity'];
        }
        return view('checkout.index', compact('cart', 'total'));
    }

    // Przetwarzanie zamówienia
    public function store(Request $request){
        $cart = session()->get('cart',[]);

        if (empty($cart)){
            return redirect()->route('cart.index')->with('success', 'Koszyk jest pusty.');
        }

        $data = $request->validate([
            'imie_klienta' => 'required|string|max:255',
            'email_klienta' => 'required|email',
            'telefon_klienta' => 'nullable|string|max:50',   
            'adres' => 'required|string|max:500',
        ]);
        
        $total = 0;
        foreach($cart as $item){
             $total += $item['price'] * $item['quantity'];
        }
        // Zapisanie zamówienia do bazy danych
        Order::create([
            'id_klienta' => Auth::id(),
            'imie_klienta' => $data['imie_klienta'],
            'email_klienta' => $data['email_klienta'],
            'telefon_klienta' => $data['telefon_klienta'],
            'adres' => $data['adres'],
            'lacznie' => $total,
            'przedmioty' => $cart,
        ]);
        // Czyszczenie koszyka po złożeniu zamówienia
        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Zamówienie zostało złożone.');
    }

    // Wyświetlanie zamówień użytkownika
    public function myOrders(){
        /** @var \App\Models\User $user; */
        $user = Auth::user();
        $orders = $user->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }
}
