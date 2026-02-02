<?php

namespace App\Http\Controllers;

use App\Models\Sale;

class SaleController extends Controller
{
    public function index()
    {
        return view('sales.index');
    }

    public function create()
    {
        return view('sales.create');
    }

    public function show(Sale $sale)
    {
        $sale->load('items.product');

        return view('sales.show', compact('sale'));
    }
}
