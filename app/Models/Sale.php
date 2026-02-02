<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Sale extends Model
{
    protected $fillable = [
        'client_name',
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

    public function payments()
    {
        return $this->hasMany(SalePayment::class);
    }

    protected function paymentStatus(): Attribute
    {
        return Attribute::get(function () {
            if ($this->remaining_amount <= 0) {
                return 'paid';
            }
            if ($this->paid_amount > 0) {
                return 'partial';
            }
            return 'unpaid';
        });
    }
}
