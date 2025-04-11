<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'supplier_id',
        'category_id',
        'name_varchar_255',
        'description_text',
        'purchase_price_decimal_10_2',
        'sale_price_decimal_10_2',
        'stock_quantity_int',
        'expiry_date',
        'requires_prescription_tinyint',
    ];

    protected $casts = [
        'purchase_price_decimal_10_2' => 'decimal:2',
        'sale_price_decimal_10_2' => 'decimal:2',
        'expiry_date' => 'date',
        'requires_prescription_tinyint' => 'boolean',
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