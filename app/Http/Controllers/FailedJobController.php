<?php

namespace App\Http\Controllers;

use App\Models\FailedJob;
use Illuminate\Http\Request;

class FailedJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $failedJobs = FailedJob::all();
        return view('failed_jobs.index', compact('failedJobs'));
    }

    /**
     * Display the specified resource.
     */
    public function show(FailedJob $failedJob)
    {
        return view('failed_jobs.show', compact('failedJob'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FailedJob $failedJob)
    {
        $failedJob->delete();
        return redirect()->route('failed_jobs.index')->with('success', 'Failed Job deleted successfully.');
    }
}