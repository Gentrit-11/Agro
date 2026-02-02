<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Purchase extends Model
{
    protected $fillable = [
        'supplier_id', 'purchase_date', 'invoice_number', 'total_amount',
        'paid_amount', 'debt_amount',
    ];

    protected function casts(): array
    {
        return [
            'purchase_date' => 'date',
            'total_amount' => 'decimal:2',
            'paid_amount' => 'decimal:2',
            'debt_amount' => 'decimal:2',
        ];
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function payments()
    {
        return $this->hasMany(PurchasePayment::class);
    }

    protected function paymentStatus(): Attribute
    {
        return Attribute::get(function () {
            if ($this->debt_amount <= 0) {
                return 'paid';
            }
            if ($this->paid_amount > 0) {
                return 'partial';
            }
            return 'unpaid';
        });
    }
}
