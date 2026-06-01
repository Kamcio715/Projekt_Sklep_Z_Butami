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
            'size' => 'required',
        ]);

        if ($shoe->stock <= 0) {
            return redirect()->back()->with('error', 'Produkt jest niedostępny.');
        }

        $availableSizes = is_array($shoe->size) ? $shoe->size : [$shoe->size];
        $selectedSize = (string) $request->input('size');

        if (!in_array($selectedSize, array_map('strval', $availableSizes), true)) {
            return redirect()->back()->with('error', 'Wybrano nieprawidłowy rozmiar.');
        }

        $quantity = max(1, (int) $request->input('quantity', 1));
        $cart = $this->getCart();

        $cartKey = $shoe->id . '_' . $selectedSize;

        $currentQuantity = isset($cart[$cartKey]) ? $cart[$cartKey]['quantity'] : 0;
        $newQuantity = $currentQuantity + $quantity;

        if ($newQuantity > $shoe->stock) {
            return redirect()->back()->with('error', 'Nie ma tyle produktów w magazynie.');
        }

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            $cart[$cartKey] = [
                'id' => $shoe->id,
                'cart_key' => $cartKey,
                'name' => $shoe->name,
                'brand' => $shoe->brand,
                'size' => $selectedSize,
                'description' => $shoe->description,
                'type' => $shoe->type,
                'price' => $shoe->price,
                'quantity' => $quantity,
                'stock' => $shoe->stock,
                'image' => $shoe->image,
            ];
        }

        $this->saveCart($cart);

        return redirect()->route('cart.index')->with('success', 'Dodano produkt do koszyka.');
    }

    public function update(Request $request, string $cartKey)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getCart();

        if (!isset($cart[$cartKey])) {
            return redirect()->route('cart.index')->with('error', 'Nie znaleziono produktu w koszyku.');
        }

        $shoe = Shoe::find($cart[$cartKey]['id']);

        if (!$shoe) {
            return redirect()->route('cart.index')->with('error', 'Produkt już nie istnieje.');
        }

        if ($request->quantity > $shoe->stock) {
            return redirect()->route('cart.index')
                ->with('error', 'Nie możesz ustawić większej ilości niż dostępna w magazynie.');
        }

        $cart[$cartKey]['quantity'] = (int) $request->quantity;
        $cart[$cartKey]['stock'] = $shoe->stock;

        $this->saveCart($cart);

        return redirect()->route('cart.index')->with('success', 'Ilość została zaktualizowana.');
    }

    public function remove(string $cartKey)
    {
        $cart = $this->getCart();

        if (isset($cart[$cartKey])) {
            unset($cart[$cartKey]);
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
