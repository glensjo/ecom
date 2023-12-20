<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $products = Product::orderBy("created_at","DESC")->paginate(10);
        $category = Category::orderBy('name','ASC')->paginate(5); 
        return view('livewire.admin.admin-product-component', ['products'=> $products, 'category'=> $category]);
    }
}
