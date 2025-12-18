<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductsTable extends Component
{
    public string $search = '';

    public function render()
    {
        $products = Product::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        if(strlen($this->search)>2){
            dd("test");
        }

        return view('livewire.products-table', [
            'products' => $products
        ]);
    }
}
