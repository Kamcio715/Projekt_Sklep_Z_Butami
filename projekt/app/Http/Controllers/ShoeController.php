<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShoeController extends Controller
{
    /**
     * Wyświetlanie listy butów
     */
    public function index()
    {
        $buty = Shoe::latest()->get();

        $marki = Shoe::select('marka')
            ->whereNotNull('marka')
            ->distinct()
            ->orderBy('marka')
            ->pluck('marka');
        
        $kategorie = Shoe::select('kategoria')
            ->whereNotNull('kategoria')
            ->distinct()
            ->orderBy('kategoria')
            ->pluck('kategoria');

        $rodzaje = Shoe::select('rodzaj')
            ->whereNotNull('rodzaj')
            ->distinct()
            ->orderBy('rodzaj')
            ->pluck('rodzaj');
        
        $rozmiary = Shoe::select('rozmiar')
            ->whereNotNull('rozmiar')
            ->distinct()
            ->orderBy('rozmiar')
            ->pluck('rozmiar');
        
        return view('shoes.index', compact('buty', 'marki', 'kategorie', 'rodzaje', 'rozmiary'));

    }

    /**
     * Wyświetlanie formularza do tworzenia nowego buta.
     */
    public function create()
    {
        return view('admin.shoes.create');
    }

    /**
     * Zapisywanie nowego buta do bazy danych.
     */
    public function store(Request $request)
    {

        // Walidacja danych
        $data = $request->validate([
            'nazwa' => 'required|string|max:255',
            'marka' => 'required|string|max:255',
            'kategoria' => 'nullable|string|max:255',
            'rodzaj' => 'nullable|string|max:255',
            'rozmiar' => 'required|numeric',
            'cena' => 'required|numeric',
            'kolor' => 'required|string|max:255',
            'opis' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // Sprawdzanie, czy użytkownik przesłał obrazek i zapisywanie go w katalogu publicznym
        if ($request->hasFile('image')) {
            $data['zdjecie'] = $request->file('image')->store('zdj', 'public');
        }
    }

    /**
     * Wyświetlanie szczegółów pojedynczego buta
     */
    public function show(Shoe $shoe)
    {
        return view('shoes.show', compact('shoe'));
    }

    /**
     * Edycja istniejącego buta
     */
    public function edit(Shoe $shoe)
    {
        return view('admin.shoes.edit', compact('shoe'));
    }

    /**
     * Aktualizowanie istniejącego buta w bazie danych
     */
    public function update(Request $request, Shoe $shoe)
    {
        // Walidacja danych
        $data = $request->validate([
            'nazwa' => 'required|string|max:255',
            'marka' => 'required|string|max:255',
            'kategoria' => 'nullable|string|max:255',
            'rodzaj' => 'nullable|string|max:255',
            'rozmiar' => 'required|numeric',
            'cena' => 'required|numeric',
            'kolor' => 'required|string|max:255',
            'opis' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);
        // Sprawdzanie, czy użytkownik przesłał nowy obrazek i aktualizowanie danych w bazie danych
        if ($request->hasFile('image')) {
            if ($shoe->zdjecie) {
                Storage::disk('public')->delete($shoe->zdjecie);
            }
            $data['zdjecie'] = $request->file('image')->store('zdj', 'public');
        }

        $shoe->update($data);
    }

    /**
     * Usuwanie buta z bazy danych
     */
    public function destroy(Shoe $shoe)
    {
        if($shoe->image){
            Storage::disk('public')->delete($shoe->image);
        }
        $shoe->delete();
        return redirect()->route('admin.shoes.index')->with('success', 'But został usunięty.');
    }
}
