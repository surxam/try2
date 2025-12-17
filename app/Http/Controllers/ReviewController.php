<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

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
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'rating'   => 'required|integer|between:1,5',
            'title'    => 'required|string|max:255',
            'comment'  => 'required|string|max:2000',
        ]);

        // Créer un nouvel avis
        $review = new Review([
            'user_id' => Auth::id(),
            'rating'  => $validated['rating'],
            'title'   => $validated['title'],
            'comment' => $validated['comment'],
        ]);

        $product->reviews()->save($review);

        return redirect()->route('products.show', $product->slug)
                         ->with('success', 'Merci pour votre avis !');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
