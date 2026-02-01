<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'unit',
        'description',
        'image',
        'is_active',
        'stock',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'stock' => 'decimal:2',
        ];
    }

    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
}
