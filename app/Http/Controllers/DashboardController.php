<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'stok' => Product::where('is_active', true)->sum('stock'),
            'borxhFurnitore' => Purchase::sum('total_amount'),
            'borxhKliente' => Sale::where('status', '!=', 'paid')->sum('remaining_amount'),
            'shitjeSot' => Sale::whereDate('sale_date', today())->sum('total_amount'),
        ]);
    }
}
