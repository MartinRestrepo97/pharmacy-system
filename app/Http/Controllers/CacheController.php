<?php

namespace App\Http\Controllers;

use App\Models\Cache;
use Illuminate\Http\Request;

class CacheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $caches = Cache::all();
        return view('caches.index', compact('caches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('caches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Cache::create($request->all());
        return redirect()->route('caches.index')->with('success', 'Cache created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cache $cache)
    {
        return view('caches.show', compact('cache'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cache $cache)
    {
        return view('caches.edit', compact('cache'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cache $cache)
    {
        $cache->update($request->all());
        return redirect()->route('caches.index')->with('success', 'Cache updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cache $cache)
    {
        $cache->delete();
        return redirect()->route('caches.index')->with('success', 'Cache deleted successfully.');
    }
}