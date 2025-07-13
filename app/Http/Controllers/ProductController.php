<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['supplier', 'category'])->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'category_id' => 'required|exists:categories,id',
            'name_varchar_255' => 'required|string|max:255',
            'description_text' => 'nullable|string',
            'purchase_price_decimal_10_2' => 'required|numeric|min:0|max:99999999.99',
            'sale_price_decimal_10_2' => 'required|numeric|min:0|max:99999999.99',
            'stock_quantity_int' => 'required|integer|min:0',
            'expiry_date' => 'nullable|date|after:today',
            'requires_prescription_tinyint' => 'boolean',
        ]);

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'supplier_id' => 'sometimes|required|exists:suppliers,id',
            'category_id' => 'sometimes|required|exists:categories,id',
            'name_varchar_255' => 'sometimes|required|string|max:255',
            'description_text' => 'nullable|string',
            'purchase_price_decimal_10_2' => 'sometimes|required|numeric|min:0|max:99999999.99',
            'sale_price_decimal_10_2' => 'sometimes|required|numeric|min:0|max:99999999.99',
            'stock_quantity_int' => 'sometimes|required|integer|min:0',
            'expiry_date' => 'nullable|date|after:today',
            'requires_prescription_tinyint' => 'boolean',
        ]);

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}