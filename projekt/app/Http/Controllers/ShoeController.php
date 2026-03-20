<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use Illuminate\Http\Request;

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
        
        $rozmiary = Shoe::select('size')
            ->whereNotNull('size')
            ->distinct()
            ->orderBy('size')
            ->pluck('size');
        
        return view('shoes.index', compact('buty', 'marki', 'kategorie', 'rodzaje', 'rozmiary'));

    }

    /**
     * Wyświetlanie formularza do tworzenia nowego buta.
     */
    public function create()
    {
        //
    }

    /**
     * Zapisywanie nowego buta do bazy danych.
     */
    public function store(Request $request)
    {
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

        if ($request->hasFile('image')) {
            $data['zdjecie'] = $request->file('image')->store('shoes', 'public');
        }
    }

    /**
     * Wyświetlanie szczegółów pojedynczego buta
     */
    public function show(Shoe $shoe)
    {
        //
    }

    /**
     * Edycja istniejącego buta
     */
    public function edit(Shoe $shoe)
    {
        //
    }

    /**
     * Aktualizowanie istniejącego buta w bazie danych
     */
    public function update(Request $request, Shoe $shoe)
    {
        //
    }

    /**
     * Usuwanie buta z bazy danych
     */
    public function destroy(Shoe $shoe)
    {
        //
    }
}
