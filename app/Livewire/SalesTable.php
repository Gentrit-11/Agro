<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Sale;

class SalesTable extends Component
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
        return view('livewire.sales-table', [
            'sales' => Sale::query()
                ->when($this->search, fn ($q) => $q->where('client_name', 'like', '%' . $this->search . '%'))
                ->orderByDesc('sale_date')
                ->paginate(10),
        ]);
    }
}
