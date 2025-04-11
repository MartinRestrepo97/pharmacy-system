<?php

namespace App\Http\Controllers;

use App\Models\JobBatch;
use Illuminate\Http\Request;

class JobBatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobBatches = JobBatch::all();
        return view('job_batches.index', compact('jobBatches'));
    }

    /**
     * Display the specified resource.
     */
    public function show(JobBatch $jobBatch)
    {
        return view('job_batches.show', compact('jobBatch'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobBatch $jobBatch)
    {
        $jobBatch->delete();
        return redirect()->route('job_batches.index')->with('success', 'Job Batch deleted successfully.');
    }
}