<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shoe;

class CartController extends Controller
{
    // Pobieranie zawartości koszyka z sesji użytkownika
    protected function getKoszyk(){
        return session()->get('koszyk', []);
    }

    // Zapisywanie zawartości koszyka do sesji użytkownika
    protected function saveKoszyk($koszyk){
        session()->put('koszyk', $koszyk);
    }
    // Wyświetlanie zawartości koszyka
    public function index(){
        $koszyk = $this->getKoszyk();
        $lacznie = 0;

        foreach($koszyk as $przedmiot){
            $lacznie += $przedmiot['cena'] * $przedmiot['ilosc'];
        }

        return view('koszyk.index', compact('koszyk', 'lacznie'));
    }

    // Zwiekszanie ilosci produktów w koszyku
    public function add(Request $request, Shoe $shoe){
        $ilosc = max(1, (int) $request->input('ilosc', 1));
        $koszyk = $this->getKoszyk();
        $but = $shoe;

        if (isset($koszyk[$but->id])){
            $ilosc += $koszyk[$but->id]['ilosc'];
        }
        else{
            $koszyk[$but->id] = [
                'id' => $but->id,
                'nazwa' => $but->nazwa,
                'marka' => $but->marka,
                'kategoria' => $but->kategoria,
                'rodzaj' => $but->rodzaj,
                'rozmiar' => $but->rozmiar,
                'cena' => $but->cena,
                'ilosc' => $ilosc,
                'zdjecie' => $but->zdjecie,
             ];
        }

        $this->saveKoszyk($koszyk);

        return redirect()->route('koszyk.index')->with('success', 'Dodano produkt do koszyka.');

    }

    // Aktualizowanie ilości produktów w koszyku
    public function update(Request $request, Shoe $shoe){
        $ilosc = (int) $request->input('ilosc', 1);
        $koszyk = $this->getKoszyk();
        $but = $shoe;

        if (isset($koszyk[$but->id])){
            if ($ilosc <= 0){
                unset($koszyk[$but->id]);
            }
            else{
                $koszyk[$but->id]['ilosc'] = $ilosc;
            }
        }

        $this->saveKoszyk($koszyk);

        return redirect()->route('koszyk.index')->with('success', 'Zaktualizowano ilość produktu w koszyku.');
    }

    // Usuwanie produktów z koszyka
    public function remove(Shoe $shoe){
        $koszyk = $this->getKoszyk();
        $but = $shoe;
        if (isset($koszyk[$but->id])){
            unset($koszyk[$but->id]);
            $this->saveKoszyk($koszyk);
        }
        return redirect()->route('koszyk.index')->with('success', 'Usunięto produkt z koszyka.');
    }

    // Wyczyszenie całego koszyka
    public function clear(){
        session()->forget('koszyk');
        return redirect()->route('koszyk.index')->with('success', 'Wyczyszczono koszyk.');
    }
}
