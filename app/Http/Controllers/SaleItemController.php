<?php

namespace App\Http\Controllers;

use App\Models\SaleItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saleItems = SaleItem::with(['sale', 'product'])->paginate(10);
        return view('sale_items.index', compact('saleItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sale_items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'product_id' => 'required|exists:products,id',
            'quantity_int' => 'required|integer|min:1',
            'unit_price_decimal_10_2' => 'required|numeric|min:0|max:99999999.99',
        ]);

        // Check if product has sufficient stock
        $product = Product::findOrFail($validated['product_id']);
        
        if ($product->stock_quantity_int < $validated['quantity_int']) {
            return back()->withErrors(['quantity_int' => "Insufficient stock. Available: {$product->stock_quantity_int}"]);
        }

        // Use database transaction to ensure data consistency
        DB::transaction(function () use ($validated, $product) {
            // Create the sale item
            SaleItem::create($validated);
            
            // Update product stock
            $product->decrement('stock_quantity_int', $validated['quantity_int']);
        });

        return redirect()->route('sale_items.index')->with('success', 'Sale item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleItem $saleItem)
    {
        return view('sale_items.show', compact('saleItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaleItem $saleItem)
    {
        return view('sale_items.edit', compact('saleItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SaleItem $saleItem)
    {
        $validated = $request->validate([
            'sale_id' => 'sometimes|required|exists:sales,id',
            'product_id' => 'sometimes|required|exists:products,id',
            'quantity_int' => 'sometimes|required|integer|min:1',
            'unit_price_decimal_10_2' => 'sometimes|required|numeric|min:0|max:99999999.99',
        ]);

        // If quantity is being updated, check stock availability
        if (isset($validated['quantity_int']) && $validated['quantity_int'] != $saleItem->quantity_int) {
            $product = Product::findOrFail($saleItem->product_id);
            $quantityDifference = $validated['quantity_int'] - $saleItem->quantity_int;
            
            if ($quantityDifference > 0 && $product->stock_quantity_int < $quantityDifference) {
                return back()->withErrors(['quantity_int' => "Insufficient stock. Available: {$product->stock_quantity_int}"]);
            }
        }

        // Use database transaction for consistency
        DB::transaction(function () use ($validated, $saleItem) {
            $oldQuantity = $saleItem->quantity_int;
            $saleItem->update($validated);
            
            // Update product stock if quantity changed
            if (isset($validated['quantity_int']) && $validated['quantity_int'] != $oldQuantity) {
                $quantityDifference = $validated['quantity_int'] - $oldQuantity;
                $product = Product::find($saleItem->product_id);
                $product->decrement('stock_quantity_int', $quantityDifference);
            }
        });

        return redirect()->route('sale_items.index')->with('success', 'Sale item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleItem $saleItem)
    {
        // Use database transaction to restore stock when deleting sale item
        DB::transaction(function () use ($saleItem) {
            $product = Product::find($saleItem->product_id);
            $product->increment('stock_quantity_int', $saleItem->quantity_int);
            $saleItem->delete();
        });

        return redirect()->route('sale_items.index')->with('success', 'Sale item deleted successfully.');
    }
}