<?php

namespace App\Http\Controllers;

use App\Models\CacheLock;
use Illuminate\Http\Request;

class CacheLockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // You might not need a full index view for this utility table.
        // Consider what actions you need to perform on cache locks.
        // For example, you might only need to view or delete specific locks.
        $cacheLocks = CacheLock::all();
        return view('cache_locks.index', compact('cacheLocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // You might not need a creation form for cache locks as they are
        // typically managed internally by the caching system.
        return view('cache_locks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Logic to store a new cache lock. This might be handled internally.
        CacheLock::create($request->all());
        return redirect()->route('cache-locks.index')->with('success', 'Cache lock created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CacheLock $cacheLock)
    {
        return view('cache_locks.show', compact('cacheLock'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CacheLock $cacheLock)
    {
        return view('cache_locks.edit', compact('cacheLock'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CacheLock $cacheLock)
    {
        $cacheLock->update($request->all());
        return redirect()->route('cache-locks.index')->with('success', 'Cache lock updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CacheLock $cacheLock)
    {
        $cacheLock->delete();
        return redirect()->route('cache-locks.index')->with('success', 'Cache lock deleted successfully.');
    }
}