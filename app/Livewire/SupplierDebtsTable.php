<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Supplier;

class SupplierDebtsTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $suppliers = Supplier::query()
            ->where('company_name', 'like', '%' . $this->search . '%')
            ->whereHas('purchases', fn ($q) => $q->where('debt_amount', '>', 0))
            ->withSum('purchases as total_purchases', 'total_amount')
            ->withSum('purchases as total_paid', 'paid_amount')
            ->withSum('purchases as outstanding_debt', 'debt_amount')
            ->orderByDesc('outstanding_debt')
            ->paginate(10);

        return view('livewire.supplier-debts-table', [
            'suppliers' => $suppliers,
        ]);
    }
}
