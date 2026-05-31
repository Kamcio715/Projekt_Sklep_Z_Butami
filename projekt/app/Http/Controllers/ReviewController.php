<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Shoe $shoe)
    {
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:3|max:1000',
        ]);

        $shoe->reviews()->create([
            'user_id' => Auth::user()->id,
            'rating' => $data['rating'],
            'content' => $data['content'],
        ]);

        return redirect()
            ->route('shoes.show', $shoe)
            ->with('success', 'Opinia została dodana.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        if (Auth::id() !== $review->user_id) {
            abort(403);
        }

        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        if (Auth::id() !== $review->user_id) {
            abort(403);
        }

        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:3|max:1000',
        ]);

        $review->update($data);

        return redirect()->route('shoes.show', $review->shoe_id)
            ->with('success', 'Opinia została zaktualizowana.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        if (Auth::id() !== $review->user_id) {
            abort(403);
        }

        $shoeId = $review->shoe_id;
        $review->delete();

        return redirect()->route('shoes.show', $shoeId)
            ->with('success', 'Opinia została usunięta.');
    }
}
