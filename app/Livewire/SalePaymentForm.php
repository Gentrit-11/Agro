<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sale;
use App\Models\SalePayment;
use Illuminate\Support\Facades\DB;

class SalePaymentForm extends Component
{
    public $sale_id;
    public $amount;
    public $payment_date;
    public $note;
    public $max_amount;

    public function mount($saleId, $maxAmount)
    {
        $this->sale_id = $saleId;
        $this->max_amount = $maxAmount;
        $this->payment_date = now()->format('Y-m-d');
    }

    public function save()
    {
        $this->validate([
            'amount' => 'required|numeric|min:0.01|max:' . $this->max_amount,
            'payment_date' => 'required|date',
            'note' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () {
            SalePayment::create([
                'sale_id' => $this->sale_id,
                'amount' => $this->amount,
                'payment_date' => $this->payment_date,
                'note' => $this->note,
            ]);

            $sale = Sale::findOrFail($this->sale_id);
            $newPaid = (float) $sale->paid_amount + (float) $this->amount;
            $newRemaining = max(0, (float) $sale->total_amount - $newPaid);

            $status = 'unpaid';
            if ($newRemaining <= 0) {
                $status = 'paid';
            } elseif ($newPaid > 0) {
                $status = 'partial';
            }

            $sale->update([
                'paid_amount' => $newPaid,
                'remaining_amount' => $newRemaining,
                'status' => $status,
            ]);
        });

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.sale-payment-form');
    }
}
