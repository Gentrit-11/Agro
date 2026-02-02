<?php

namespace App\Http\Controllers;

use App\Models\Sale;

class ClientDebtController extends Controller
{
    public function index()
    {
        return view('client-debts.index');
    }

    public function show(string $clientName)
    {
        $clientName = urldecode($clientName);

        $sales = Sale::where('client_name', $clientName)
            ->where('remaining_amount', '>', 0)
            ->orderBy('sale_date')
            ->with('payments')
            ->get();

        $totalSales = Sale::where('client_name', $clientName)->sum('total_amount');
        $totalPaid = Sale::where('client_name', $clientName)->sum('paid_amount');
        $totalDebt = Sale::where('client_name', $clientName)->sum('remaining_amount');

        return view('client-debts.show', compact('clientName', 'sales', 'totalSales', 'totalPaid', 'totalDebt'));
    }
}
