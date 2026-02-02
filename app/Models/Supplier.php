<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Supplier extends Model
{
    protected $fillable = [
        'company_name',
        'business_number',
        'owner_name',
        'phone',
        'address',
        'city',
        'country',
        'note',
        'payment_term_days',
        'credit_limit',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'payment_term_days' => 'integer',
            'credit_limit' => 'decimal:2',
        ];
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    protected function totalDebt(): Attribute
    {
        return Attribute::get(fn () => $this->purchases()->sum('debt_amount'));
    }
}

