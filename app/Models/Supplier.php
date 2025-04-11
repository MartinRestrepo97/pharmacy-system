<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_varchar_255',
        'contact_person_varchar_255',
        'phone_varchar_255',
        'email_varchar_255',
        'address_text',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_id'); // 'supplier_id' is the foreign key in the 'products' table
    }
}