<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected function getCart()
    {
        return session()->get('cart', []);
    }

    protected function saveCart($cart)
    {
        session()->put('cart', $cart);
    }

    // Wyświetlanie zawartości koszyka
    public function index()
    {
        $cart = $this->getCart();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    // Zwiekszanie ilosci produktów w koszyku
    public function add(Request $request, Shoe $shoe)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if($shoe->stock <= 0){
            return redirect()->back()->with('error', 'Produkt jest niedostępny.');
        }

        $quantity = max(1, (int) $request->input('quantity', 1));
        $cart = $this->getCart();

        $currentQuantity = isset($cart[$shoe->id]) ? $cart[$shoe->id]['quantity'] : 0;
        $newQuantity = $currentQuantity + $quantity;

        if ($newQuantity > $shoe->stock) {
            return redirect()->back()->with('error', 'Nie ma tyle produktów w magazynie.');
        }

        if (isset($cart[$shoe->id])) {
            $cart[$shoe->id]['quantity'] += $quantity;
        } else {
            $cart[$shoe->id] = [
                'id' => $shoe->id,
                'name' => $shoe->name,
                'brand' => $shoe->brand,
                'size' => $shoe->size,
                'description' => $shoe->description,
                'type' => $shoe->type,
                'price' => $shoe->price,
                'quantity' => $newQuantity,
                'stock' => $shoe->stock,
                'image' => $shoe->image,
            ];
        }

        $this->saveCart($cart);

        return redirect()->route('cart.index')->with('success', 'Dodano produkt do koszyka.');
    }

    public function update(Request $request, Shoe $shoe)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($request->quantity > $shoe->stock) {
            return redirect()->route('cart.index')
                ->with('error', 'Nie możesz ustawić większej ilości niż dostępna w magazynie.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$shoe->id])) {
            $cart[$shoe->id]['quantity'] = (int) $request->quantity;
            $cart[$shoe->id]['stock'] = $shoe->stock;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Ilość została zaktualizowana.');
    }


    public function remove(Shoe $shoe)
    {
        $cart = $this->getCart();

        if (isset($cart[$shoe->id])) {
            unset($cart[$shoe->id]);
            $this->saveCart($cart);
        }

        return back()->with('success', 'Usunięto produkt z koszyka.');
    }

    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Koszyk został wyczyszczony.');
    }
}
