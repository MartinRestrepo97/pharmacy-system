<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'total_jobs',
        'pending_jobs',
        'failed_jobs',
        'failed_job_ids',
        'options',
        'cancelled_at',
        'finished_at',
    ];

    protected $casts = [
        'failed_job_ids' => 'json',
        'cancelled_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function failedJobs()
    {
        return $this->hasMany(FailedJob::class);
    }
}