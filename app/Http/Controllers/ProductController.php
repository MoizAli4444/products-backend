<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
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
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();

        $product = Product::create($validatedData);

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product, 200);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        $product->update($validatedData);

        return response()->json($product, 200);
    }
    /**
     * Remove the specified resource from storage.
     */


    public function destroy(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'id' => 'required|exists:products,id',
            ]);

            // Get the product ID from the request
            $productId = $request->id;

            // Find the product by ID
            $product = Product::findOrFail($productId);

            // Delete the product
            $product->delete();

            // Return a success response
            return response()->json(['message' => 'Product deleted successfully'], 204);
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}