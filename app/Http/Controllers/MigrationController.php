<?php

namespace App\Http\Controllers;

use App\Models\Migration;
use Illuminate\Http\Request;

class MigrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $migrations = Migration::all();
        return view('migrations.index', compact('migrations'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Migration $migration)
    {
        return view('migrations.show', compact('migration'));
    }
}