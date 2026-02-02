<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use App\Models\PurchasePayment;
use Illuminate\Support\Facades\DB;

class PaymentForm extends Component
{
    public $purchase_id;
    public $amount;
    public $payment_date;
    public $note;
    public $max_amount;

    public function mount($purchaseId, $maxAmount)
    {
        $this->purchase_id = $purchaseId;
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
            PurchasePayment::create([
                'purchase_id' => $this->purchase_id,
                'amount' => $this->amount,
                'payment_date' => $this->payment_date,
                'note' => $this->note,
            ]);

            $purchase = Purchase::findOrFail($this->purchase_id);
            $newPaid = (float) $purchase->paid_amount + (float) $this->amount;
            $newDebt = max(0, (float) $purchase->total_amount - $newPaid);

            $purchase->update([
                'paid_amount' => $newPaid,
                'debt_amount' => $newDebt,
            ]);
        });

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.payment-form');
    }
}
