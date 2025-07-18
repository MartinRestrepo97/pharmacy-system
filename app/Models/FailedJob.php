<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'connection',
        'queue',
        'payload',
        'exception',
        'failed_at',
    ];

    protected $casts = [
        'failed_at' => 'datetime',
    ];

    public function jobBatch()
    {
        return $this->belongsTo(JobBatch::class);
    }
}