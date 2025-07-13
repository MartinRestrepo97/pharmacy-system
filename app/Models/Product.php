<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Mass-assignable attributes. These names must exactly match the column
     * names defined in the `products` table migration; otherwise Eloquent
     * will throw a MassAssignmentException and the record will not be saved.
     */
    protected $fillable = [
        'supplier_id',
        'category_id',
        'name',
        'description',
        'purchase_price',
        'sale_price',
        'stock_quantity',
        'expiry_date',
        'requires_prescription',
    ];

    protected $casts = [
        'purchase_price' => 'decimal:2',
        'sale_price'      => 'decimal:2',
        'expiry_date'     => 'date',
        // `requires_prescription` is stored as a string ("yes"/"no") in the
        // current schema, so we do not cast it to boolean.
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
}