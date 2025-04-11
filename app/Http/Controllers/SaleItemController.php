<?php

namespace App\Http\Controllers;

use App\Models\SaleItem;
use Illuminate\Http\Request;

class SaleItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saleItems = SaleItem::all();
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
        SaleItem::create($request->all());
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
        $saleItem->update($request->all());
        return redirect()->route('sale_items.index')->with('success', 'Sale item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleItem $saleItem)
    {
        $saleItem->delete();
        return redirect()->route('sale_items.index')->with('success', 'Sale item deleted successfully.');
    }
}