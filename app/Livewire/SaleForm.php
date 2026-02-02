<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Facades\DB;

class SaleForm extends Component
{
    public $client_name = '';
    public $sale_type = 'retail';
    public $sale_date;
    public $paid_amount = 0;

    public $items = [];

    public function mount()
    {
        $this->sale_date = now()->format('Y-m-d');
        $this->items[] = $this->emptyRow();
    }

    #[Computed]
    public function products()
    {
        return Product::where('is_active', true)->get();
    }

    #[Computed]
    public function grandTotal()
    {
        $total = 0;
        foreach ($this->items as $row) {
            $total += $this->rowTotal($row);
        }
        return round($total, 2);
    }

    #[Computed]
    public function debtDisplay()
    {
        return max(0, round($this->grandTotal - (float) $this->paid_amount, 2));
    }

    protected function isCope(string $unit): bool
    {
        return str_starts_with(mb_strtolower($unit), 'cop');
    }

    protected function rowTotal(array $row): float
    {
        $unit = $row['unit'] ?? 'kg';
        if ($this->isCope($unit)) {
            $qty = (float) ($row['quantity'] ?? 0);
        } else {
            $pkgQty  = (float) ($row['package_quantity'] ?? 0);
            $basePer = (float) ($row['base_per_package'] ?? 0);
            $qty = ($pkgQty > 0 && $basePer > 0)
                ? $pkgQty * $basePer
                : (float) ($row['quantity'] ?? 0);
        }
        return $qty * (float) ($row['price'] ?? 0);
    }

    protected function emptyRow()
    {
        return [
            'product_id' => null,
            'unit' => 'kg',
            'quantity' => 0,
            'package_quantity' => 0,
            'base_per_package' => 0,
            'price' => 0,
            'total' => 0,
        ];
    }

    public function updatedItems($value, $key)
    {
        if (str_ends_with($key, '.product_id') && $value) {
            $index = explode('.', $key)[0];
            $product = Product::find($value);
            if ($product) {
                $this->items[$index]['unit'] = $product->unit ?? 'kg';
                if ($this->isCope($product->unit ?? 'kg')) {
                    $this->items[$index]['package_quantity'] = 0;
                    $this->items[$index]['base_per_package'] = 0;
                }
            }
        }
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
        $rules = [
            'client_name' => 'nullable|string|max:255',
            'sale_type' => 'required|in:wholesale,retail',
            'sale_date' => 'required|date',
            'paid_amount' => 'nullable|numeric|min:0',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.price' => 'required|numeric|min:0.01',
        ];

        foreach ($this->items as $i => $row) {
            $unit = $row['unit'] ?? 'kg';
            if ($this->isCope($unit)) {
                $rules["items.{$i}.quantity"] = 'required|integer|min:1';
            } else {
                $rules["items.{$i}.quantity"] = 'required|numeric|min:0.01';
            }
        }

        $this->validate($rules);

        DB::transaction(function () {
            $paidAmount = (float) ($this->paid_amount ?? 0);

            $sale = Sale::create([
                'client_name' => $this->client_name ?: null,
                'sale_type' => $this->sale_type,
                'sale_date' => $this->sale_date,
                'total_amount' => 0,
                'paid_amount' => 0,
                'remaining_amount' => 0,
                'status' => 'unpaid',
            ]);

            $grandTotal = 0;

            foreach ($this->items as $row) {
                $unit = $row['unit'] ?? 'kg';
                $cope = $this->isCope($unit);

                if ($cope) {
                    $qty = (int) $row['quantity'];
                } else {
                    $pkgQty  = (float) ($row['package_quantity'] ?? 0);
                    $basePer = (float) ($row['base_per_package'] ?? 0);
                    $qty = ($pkgQty > 0 && $basePer > 0)
                        ? $pkgQty * $basePer
                        : (float) $row['quantity'];
                }

                $rowTotal = $qty * (float) $row['price'];

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $row['product_id'],
                    'quantity' => $qty,
                    'package_quantity' => $cope ? 0 : (int) ($row['package_quantity'] ?? 0),
                    'base_per_package' => $cope ? 0 : (float) ($row['base_per_package'] ?? 0),
                    'price' => $row['price'],
                    'total' => $rowTotal,
                ]);

                Product::where('id', $row['product_id'])
                    ->decrement('stock', $qty);

                $grandTotal += $rowTotal;
            }

            $remaining = max(0, $grandTotal - $paidAmount);
            $actualPaid = min($paidAmount, $grandTotal);

            if ($remaining <= 0) {
                $status = 'paid';
            } elseif ($actualPaid > 0) {
                $status = 'partial';
            } else {
                $status = 'unpaid';
            }

            $sale->update([
                'total_amount' => $grandTotal,
                'paid_amount' => $actualPaid,
                'remaining_amount' => $remaining,
                'status' => $status,
            ]);
        });

        return redirect()->route('sales.index');
    }

    public function render()
    {
        return view('livewire.sale-form');
    }
}
