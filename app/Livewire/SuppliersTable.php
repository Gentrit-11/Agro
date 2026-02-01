<?php

    namespace App\Livewire;

    use Livewire\Component;
    use App\Models\Supplier;

    class SuppliersTable extends Component
    {
        public $search = '';

        public function render()
        {
            return view('livewire.suppliers-table', [
                'suppliers' => Supplier::where('company_name', 'like', '%' . $this->search . '%')
                    ->orderBy('company_name')
                    ->get()
            ]);
        }

    }
