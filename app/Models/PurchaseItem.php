<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity_base',
        'package_quantity',
        'base_per_package',
        'price_per_base_unit',
        'total',
    ];

    protected function casts(): array
    {
        return [
            'quantity_base' => 'decimal:3',
            'package_quantity' => 'integer',
            'base_per_package' => 'decimal:3',
            'price_per_base_unit' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
