<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SaleController extends Controller
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
        $this->authorize('viewAny', Sale::class);
        
        $sales = Sale::with(['customer', 'user'])->paginate(15);
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Sale::class);
        
        return view('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Sale::class);
        
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'sale_date' => 'required|date',
            'total_amount_decimal_12_2' => 'required|numeric|min:0',
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
        $this->authorize('view', $sale);
        
        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $this->authorize('update', $sale);
        
        return view('sales.edit', compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $this->authorize('update', $sale);
        
        $validated = $request->validate([
            'customer_id' => 'sometimes|exists:customers,id',
            'user_id' => 'sometimes|exists:users,id',
            'sale_date' => 'sometimes|date',
            'total_amount_decimal_12_2' => 'sometimes|numeric|min:0',
            'payment_method_varchar_255' => 'sometimes|string|max:255',
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
        $this->authorize('delete', $sale);
        
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}