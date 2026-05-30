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
        $shoes = Shoe::latest()->get();

        $brands = Shoe::selectRaw('brand, COUNT(*) as total')
            ->whereNotNull('brand')
            ->groupBy('brand')
            ->orderBy('brand')
            ->get();

        $categories = Shoe::selectRaw('category, COUNT(*) as total')
            ->whereNotNull('category')
            ->groupBy('category')
            ->orderBy('category')
            ->get();

        $types = Shoe::selectRaw('type, COUNT(*) as total')
            ->whereNotNull('type')
            ->groupBy('type')
            ->orderBy('type')
            ->get();

        $sizes = Shoe::selectRaw('size, COUNT(*) as total')
            ->whereNotNull('size')
            ->groupBy('size')
            ->orderBy('size')
            ->get();

        return view('shoes.index', compact('shoes', 'brands', 'categories', 'types', 'sizes'));
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'brand' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Sprawdzanie, czy użytkownik przesłał obrazek i zapisywanie go w katalogu publicznym
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('zdj', 'public');
        }
    }

    /**
     * Wyświetlanie szczegółów pojedynczego buta
     */
    public function show(Shoe $shoe)
    {
        return view('shoes.show', compact('shoe'));
    }
    
    // Wyświetlanie listy butów w panelu administratora
    public function adminIndex()
    {
        $shoes = Shoe::all();
        return view('admin.shoes.index', compact('shoes'));
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'brand' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        // Sprawdzanie, czy użytkownik przesłał nowy obrazek i aktualizowanie danych w bazie danych
        if ($request->hasFile('image')) {
            if ($shoe->image) {
                Storage::disk('public')->delete($shoe->image);
            }
            $data['image'] = $request->file('image')->store('zdj', 'public');
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
