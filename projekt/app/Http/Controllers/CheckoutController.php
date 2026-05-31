<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('success', 'Koszyk jest pusty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('success', 'Koszyk jest pusty.');
        }

        $data = $request->validate([
            'customer_name'   => 'required|string|max:255',
            'customer_email'  => 'required|email',
            'customer_phone'  => 'nullable|string|max:50',
            'address'         => 'required|string|max:500',
            'delivery_method' => 'required|in:kurier,paczkomat,odbior_osobisty',
            'payment_method'  => 'required|in:blik,karta,przy_odbiorze',
        ]);

        $total = 0;
        
        foreach ($cart as $item) {
            $shoe = Shoe::find($item['id']);
            if (!$shoe) {
                return redirect()->back()->with('error', 'Jeden z produktów nie jest już dostępny.');
            }
            if ($item['quantity'] > $shoe->stock) {
                return redirect()->back()->with('error', 'Nie ma tyle produktów w magazynie: ' . $shoe->name);
            }
            $total += $item['price'] * $item['quantity'];
        }

        $paymentStatus = $data['payment_method'] === 'przy_odbiorze' ? 'pending' : 'paid';

        Order::create([
        'user_id' => Auth::check() ? Auth::id() : null,
        'customer_name'   => $data['customer_name'],
        'customer_email'  => $data['customer_email'],
        'customer_phone'  => $data['customer_phone'] ?? null,
        'address'         => $data['address'],
        'delivery_method' => $data['delivery_method'],
        'payment_method'  => $data['payment_method'],
        'payment_status'  => $paymentStatus,
        'total'           => $total,
        'items'           => $cart,
        ]);

        foreach ($cart as $item) {
            $shoe = Shoe::find($item['id']);
            $shoe->decrement('stock', $item['quantity']);
        }


        session()->forget('cart');

        return redirect()->route('shoes.index')->with('success', 'Zamówienie zostało złożone.');
    }


    public function myOrders()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('orders.my', compact('orders'));
    }
}
