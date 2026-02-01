<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'sale_type',
        'total_amount',
        'paid_amount',
        'remaining_amount',
        'status',
        'sale_date',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
            'paid_amount' => 'decimal:2',
            'remaining_amount' => 'decimal:2',
            'sale_date' => 'date',
        ];
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
}
