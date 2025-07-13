<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Product::class);
        
        $products = Product::with(['supplier', 'category'])->paginate(15);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Product::class);
        
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Product::class);
        
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'category_id' => 'required|exists:categories,id',
            'name_varchar_255' => 'required|string|max:255',
            'description_text' => 'nullable|string',
            'purchase_price_decimal_10_2' => 'required|numeric|min:0',
            'sale_price_decimal_10_2' => 'required|numeric|min:0',
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
        $this->authorize('view', $product);
        
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);
        
        $validated = $request->validate([
            'supplier_id' => 'sometimes|exists:suppliers,id',
            'category_id' => 'sometimes|exists:categories,id',
            'name_varchar_255' => 'sometimes|string|max:255',
            'description_text' => 'nullable|string',
            'purchase_price_decimal_10_2' => 'sometimes|numeric|min:0',
            'sale_price_decimal_10_2' => 'sometimes|numeric|min:0',
            'stock_quantity_int' => 'sometimes|integer|min:0',
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
        $this->authorize('delete', $product);
        
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}