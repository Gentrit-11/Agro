<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Support\Facades\DB;

class PurchaseForm extends Component
{
    public $supplier_id;
    public $invoice_number;
    public $purchase_date;

    public $items = [];

    public function mount()
    {
        $this->purchase_date = now()->format('Y-m-d');
        $this->items[] = $this->emptyRow();
    }

    #[Computed]
    public function suppliers()
    {
        return Supplier::where('is_active', true)->get();
    }

    #[Computed]
    public function products()
    {
        return Product::where('is_active', true)->get();
    }

    protected function emptyRow()
    {
        return [
            'product_id' => null,
            'quantity_base' => 0,
            'package_quantity' => 0,
            'base_per_package' => 0,
            'price_per_base_unit' => 0,
            'total' => 0,
        ];
    }

    public function addRow()
    {
        $this->items[] = $this->emptyRow();
    }

    public function removeRow($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function save()
    {
        $this->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required|date',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity_base' => 'required|numeric|min:0.01',
            'items.*.price_per_base_unit' => 'required|numeric|min:0.01',
        ]);

        DB::transaction(function () {

            $purchase = Purchase::create([
                'supplier_id' => $this->supplier_id,
                'purchase_date' => $this->purchase_date,
                'invoice_number' => $this->invoice_number,
                'total_amount' => 0,
            ]);

            $grandTotal = 0;

            foreach ($this->items as $row) {

                $pkgQty  = (float) ($row['package_quantity'] ?? 0);
                $basePer = (float) ($row['base_per_package'] ?? 0);
                $qtyBase = ($pkgQty > 0 && $basePer > 0)
                    ? $pkgQty * $basePer
                    : (float) $row['quantity_base'];

                $rowTotal = $qtyBase * (float) $row['price_per_base_unit'];

                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $row['product_id'],
                    'quantity_base' => $qtyBase,
                    'package_quantity' => $row['package_quantity'],
                    'base_per_package' => $row['base_per_package'],
                    'price_per_base_unit' => $row['price_per_base_unit'],
                    'total' => $rowTotal,
                ]);

                Product::where('id', $row['product_id'])
                    ->increment('stock', $qtyBase);

                $grandTotal += $rowTotal;
            }

            $purchase->update([
                'total_amount' => $grandTotal,
            ]);
        });

        return redirect()->route('purchases.index');
    }

    public function render()
    {
        return view('livewire.purchase-form');
    }
}
