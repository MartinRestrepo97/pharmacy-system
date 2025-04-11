<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'identity_document_varchar_255',
        'phone_varchar_255',
        'email_varchar_255',
        'address_text',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}