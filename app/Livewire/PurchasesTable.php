<?php

    namespace App\Livewire;

    use Livewire\Component;
    use App\Models\Purchase;
    use Livewire\WithPagination;

    class PurchasesTable extends Component
    {
        use WithPagination;

        protected $paginationTheme = 'bootstrap';

        public $search = '';

        public function render()
        {
            return view('livewire.purchases-table', [
                'purchases' => Purchase::with('supplier')
                    ->whereHas('supplier', function ($q) {
                        $q->where('company_name', 'like', '%' . $this->search . '%');
                    })
                    ->orderByDesc('purchase_date')
                    ->paginate(10),
            ]);
        }
    }
