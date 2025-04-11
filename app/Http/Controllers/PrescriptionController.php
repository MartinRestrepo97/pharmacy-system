<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prescriptions = Prescription::all();
        return view('prescriptions.index', compact('prescriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prescriptions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Prescription::create($request->all());
        return redirect()->route('prescriptions.index')->with('success', 'Prescription created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prescription $prescription)
    {
        return view('prescriptions.show', compact('prescription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prescription $prescription)
    {
        return view('prescriptions.edit', compact('prescription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prescription $prescription)
    {
        $prescription->update($request->all());
        return redirect()->route('prescriptions.index')->with('success', 'Prescription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
        return redirect()->route('prescriptions.index')->with('success', 'Prescription deleted successfully.');
    }
}