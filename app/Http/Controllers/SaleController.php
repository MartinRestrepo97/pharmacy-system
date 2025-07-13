<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with(['customer', 'user', 'saleItems'])->paginate(10);
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'sale_date' => 'required|date',
            'total_amount_decimal_12_2' => 'required|numeric|min:0|max:999999999999.99',
            'payment_method_varchar_255' => 'required|string|max:255',
            'notes_text' => 'nullable|string',
        ]);

        Sale::create($validated);
        return redirect()->route('sales.index')->with('success', 'Sale created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        return view('sales.edit', compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'customer_id' => 'sometimes|required|exists:customers,id',
            'user_id' => 'sometimes|required|exists:users,id',
            'sale_date' => 'sometimes|required|date',
            'total_amount_decimal_12_2' => 'sometimes|required|numeric|min:0|max:999999999999.99',
            'payment_method_varchar_255' => 'sometimes|required|string|max:255',
            'notes_text' => 'nullable|string',
        ]);

        $sale->update($validated);
        return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}