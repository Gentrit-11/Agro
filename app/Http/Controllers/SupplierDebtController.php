<?php

namespace App\Http\Controllers;

use App\Models\Supplier;

class SupplierDebtController extends Controller
{
    public function index()
    {
        return view('debts.index');
    }

    public function show(Supplier $supplier)
    {
        $supplier->load([
            'purchases' => fn ($q) => $q->where('debt_amount', '>', 0)->orderByDesc('purchase_date'),
            'purchases.payments' => fn ($q) => $q->orderByDesc('payment_date'),
        ]);

        $totalPurchases = $supplier->purchases()->sum('total_amount');
        $totalPaid = $supplier->purchases()->sum('paid_amount');
        $totalDebt = $supplier->purchases()->sum('debt_amount');

        return view('debts.show', compact('supplier', 'totalPurchases', 'totalPaid', 'totalDebt'));
    }
}
