<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use Illuminate\Http\Request;

class ShoeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buty = Shoe::latest()->get();

        $marki = Shoe::select('brand')
            ->whereNotNull('brand')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand');
        
        $kategorie = Shoe::select('kategorie')
            ->whereNotNull('kategorie')
            ->distinct()
            ->orderBy('kategorie')
            ->pluck('kategorie');

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(Shoe $shoe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shoe $shoe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shoe $shoe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shoe $shoe)
    {
        //
    }
}
