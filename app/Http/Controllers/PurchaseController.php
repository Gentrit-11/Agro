<?php

    namespace App\Http\Controllers;

    use App\Models\Purchase;
    use App\Models\Product;
    use App\Models\Supplier;

    class PurchaseController extends Controller
    {
        public function index()
        {
            return view('purchases.index', [
                'purchases' => Purchase::with('supplier')->latest()->get()
            ]);
        }

        public function create()
        {
            return view('purchases.create', [
                'suppliers' => Supplier::where('is_active', true)->get(),
                'products' => Product::where('is_active', true)->get(),
            ]);
        }

        public function show(Purchase $purchase)
        {
            $purchase->load('supplier', 'items.product', 'payments');

            return view('purchases.show', compact('purchase'));
        }
    }
