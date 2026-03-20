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
        $koszyk = session()->get('koszyk',[]);

        if (empty($koszyk)){
            return redirect()->route('koszyk.index')->with('success', 'Koszyk jest pusty.');
        }

        $lacznie = 0;
        foreach($koszyk as $przedmiot){
            $lacznie += $przedmiot['cena'] * $przedmiot['ilosc'];
        }
        return view('podsumowanie.index', compact('koszyk', 'lacznie'));
    }

    // Przetwarzanie zamówienia
    public function store(Request $request){
        $koszyk = session()->get('koszyk',[]);

        if (empty($koszyk)){
            return redirect()->route('koszyk.index')->with('success', 'Koszyk jest pusty.');
        }

        $data = $request->validate([
            'imie_klienta' => 'required|string|max:255',
            'email_klienta' => 'required|email',
            'telefon_klienta' => 'nullable|string|max:50',   
            'adres' => 'required|string|max:500',
        ]);
        
        $lacznie = 0;
        foreach($koszyk as $przedmiot){
            $lacznie += $przedmiot['cena'] * $przedmiot['ilosc'];
        }
        // Zapisanie zamówienia do bazy danych
        Order::create([
            'id_klienta' => Auth::id(),
            'imie_klienta' => $data['imie_klienta'],
            'email_klienta' => $data['email_klienta'],
            'telefon_klienta' => $data['telefon_klienta'],
            'adres' => $data['adres'],
            'lacznie' => $lacznie,
            'przedmioty' => $koszyk,
        ]);
        // Czyszczenie koszyka po złożeniu zamówienia
        session()->forget('koszyk');

        return redirect()->route('zamowienia.index')->with('success', 'Zamówienie zostało złożone.');
    }

    // Wyświetlanie zamówień użytkownika
    public function mojeZamowienia(){
        /** @var \App\Models\User $user; */
        $user = Auth::user();
        $zamowienia = $user->orders()->latest()->paginate(10);
        return view('zamowienia.index', compact('zamowienia'));
    }
}
