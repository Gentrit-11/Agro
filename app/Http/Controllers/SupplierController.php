<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return view('suppliers.index');
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:10',

            // OPTIONAL
            'business_number' => 'nullable|string|max:255|unique:suppliers',
            'owner_name' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'payment_term_days' => 'nullable|integer',
            'credit_limit' => 'nullable|numeric',
        ]);

        $data['is_active'] = $request->has('is_active');

        Supplier::create($data);

        return redirect()->route('suppliers.index')
            ->with('success', 'Furnitori u shtua me sukses');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'business_number' => 'nullable|string|max:255|unique:suppliers,business_number,' . $supplier->id,
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:10',

            'owner_name' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'payment_term_days' => 'nullable|integer',
            'credit_limit' => 'nullable|numeric',
        ]);

        $data['is_active'] = $request->has('is_active');

        $supplier->update($data);

        return redirect()->route('suppliers.index')
            ->with('success', 'Furnitori u përditësua');
    }

    public function toggle(Supplier $supplier)
    {
        $supplier->update([
            'is_active' => !$supplier->is_active,
        ]);

        return back();
    }
}
