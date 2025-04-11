<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Migration extends Model
{
    use HasFactory;

    protected $fillable = [
        'migration',
        'batch',
    ];

    public $timestamps = false; // Assuming no created_at/updated_at
}