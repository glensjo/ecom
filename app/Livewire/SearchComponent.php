<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class SearchComponent extends Component
{
    use WithPagination;

    public $pageSize = 12;
    public $orderBy = "Default Sorting";
    public $min_value = 0;
    public $max_value = 250000;
    
    public $q;
    public $search_term;

    public function mount()
    {
        $this->fill(request()->only('q'));
        $this->search_term = '%'.$this->q . '%';
    }

    public function changePageSize($size)
    {
        $this->pageSize = $size;
    }

    public function changeOrderBy($order)
    {
        $this->orderBy = $order;
    }

    public function render()
    {
        if($this->orderBy == 'Price: Low to High') 
        {
            $products = Product::where('name','like',$this->search_term)->whereBetween('regular_price',[$this->min_value,$this->max_value])->orderBy('regular_price', 'ASC')->paginate($this->pageSize);
        }
        else if($this->orderBy == 'Price: High to Low') 
        {
            $products = Product::where('name','like',$this->search_term)->whereBetween('regular_price',[$this->min_value,$this->max_value])->orderBy('regular_price', 'DESC')->paginate($this->pageSize);
        }
        else if($this->orderBy == 'Sort by Newness') 
        {
            $products = Product::where('name','like',$this->search_term)->whereBetween('regular_price',[$this->min_value,$this->max_value])->orderBy('created_at', 'ASC')->paginate($this->pageSize);
        }
        else
        {
            $products = Product::where('name','like',$this->search_term)->whereBetween('regular_price',[$this->min_value,$this->max_value])->paginate($this->pageSize);
        }  
        $categories = Category::orderBy('name','ASC')->get();     
        return view('livewire.search-component',['products'=>$products, 'categories'=>$categories]);
    }
}
