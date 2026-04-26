<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shoe;

class CartController extends Controller
{
    // Pobieranie zawartości koszyka z sesji użytkownika
    protected function getCart(){
        return session()->get('cart', []);
    }

    // Zapisywanie zawartości koszyka do sesji użytkownika
    protected function saveCart($cart){
        session()->put('cart', $cart);
    }
    // Wyświetlanie zawartości koszyka
    public function index(){
        $cart = $this->getCart();
        $total = 0;

        foreach($cart as $item){
             $total += $item['price'] * $item['quantity'];
        }
        return view('cart.index', compact('cart', 'total'));
    }

    // Zwiekszanie ilosci produktów w koszyku
    public function add(Request $request, Shoe $shoe){
        $quantity = max(1, (int) $request->input('quantity', 1));
        $cart = $this->getCart();;

        if (isset($cart[$shoe->id])){
            $quantity += $cart[$shoe->id]['quantity'];
        }
        else{
            $cart[$shoe->id] = [
                'id' => $shoe->id,
                'nazwa' => $shoe->nazwa,
                'marka' => $shoe->marka,
                'kategoria' => $shoe->kategoria,
                'rodzaj' => $shoe->rodzaj,
                'rozmiar' => $shoe->rozmiar,
                'cena' => $shoe->cena,
                'ilosc' => $quantity,
                'zdjecie' => $shoe->zdjecie,
             ];
        }
        // Zapisanie zaktualizowanego koszyka do sesji
        $this->saveCart($cart);

        return redirect()->route('cart.index')->with('success', 'Dodano produkt do koszyka.');

    }

    // Aktualizowanie ilości produktów w koszyku
    public function update(Request $request, Shoe $shoe){
        $quantity = (int) $request->input('quantity', 1);
        $cart = $this->getCart();

        if (isset($cart[$shoe->id])){
            if ($quantity <= 0){
                unset($cart[$shoe->id]);
            }
            else{
                $cart[$shoe->id]['quantity'] = $quantity;
            }
        }
        // Zapisanie zaktualizowanego koszyka do
        $this->saveCart($cart);

        return redirect()->route('cart.index')->with('success', 'Zaktualizowano ilość produktu w koszyku.');
    }

    // Usuwanie produktów z koszyka
    public function remove(Shoe $shoe){
        $cart = $this->getCart();
        if (isset($cart[$shoe->id])){
            unset($cart[$shoe->id]);
            $this->saveCart($cart);
        }
        return redirect()->route('cart.index')->with('success', 'Usunięto produkt z koszyka.');
    }

    // Wyczyszenie całego koszyka
    public function clear(){
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Wyczyszczono koszyk.');
    }
}
