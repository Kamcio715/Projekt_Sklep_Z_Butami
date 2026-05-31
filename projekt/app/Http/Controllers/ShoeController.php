<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShoeController extends Controller
{
    public function index(Request $request)
    {
        $query = Shoe::query();

        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $shoes = $query->latest()->paginate(12)->withQueryString();

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

        return view('shoes.index', compact('shoes', 'brands', 'categories', 'types'));
    }




    public function show(Shoe $shoe)
    {
        $shoe->load(['reviews.user']);

        $recommendedShoes = Shoe::where('category', $shoe->category)
            ->where('id', '!=', $shoe->id)
            ->latest()
            ->take(4)
            ->get();

        return view('shoes.show', compact('shoe', 'recommendedShoes'));

    }

    public function adminIndex()
    {
        $shoes = Shoe::latest()->paginate(15);

        return view('admin.shoes.index', compact('shoes'));
    }

    public function create()
    {
        return view('admin.shoes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'size' => 'required|numeric|min:20|max:50',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'color' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('shoes', 'public');
        }

        Shoe::create($data);

        return redirect()->route('admin.shoes.index')->with('success', 'But został dodany.');
    }

    public function edit(Shoe $shoe)
    {
        return view('admin.shoes.edit', compact('shoe'));
    }

    public function update(Request $request, Shoe $shoe)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'size' => 'required|numeric|min:20|max:50',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'color' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($shoe->image) {
                Storage::disk('public')->delete($shoe->image);
            }

            $data['image'] = $request->file('image')->store('shoes', 'public');
        }

        $shoe->update($data);

        return redirect()->route('admin.shoes.index')->with('success', 'But został zaktualizowany.');
    }

    public function destroy(Shoe $shoe)
    {
        if ($shoe->image) {
            Storage::disk('public')->delete($shoe->image);
        }

        $shoe->delete();

        return redirect()->route('admin.shoes.index')->with('success', 'But został usunięty.');
    }
}
