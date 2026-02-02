<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class ClientDebtsTable extends Component
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
        $clients = Sale::query()
            ->select(
                'client_name',
                DB::raw('SUM(total_amount) as total_sales'),
                DB::raw('SUM(paid_amount) as total_paid'),
                DB::raw('SUM(remaining_amount) as outstanding_debt')
            )
            ->whereNotNull('client_name')
            ->where('client_name', '!=', '')
            ->when($this->search, fn ($q) => $q->where('client_name', 'like', '%' . $this->search . '%'))
            ->groupBy('client_name')
            ->having('outstanding_debt', '>', 0)
            ->orderByDesc('outstanding_debt')
            ->paginate(10);

        return view('livewire.client-debts-table', [
            'clients' => $clients,
        ]);
    }
}
