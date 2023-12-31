<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination;
    public $pageSize = 12;
    public $orderBy = "Default Sorting";
    public $min_value = 0;
    public $max_value = 250000;

    public function store($product_id,$product_name,$product_price)
    {
        Cart::add($product_id, $product_name,1, $product_price)->associate('\App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('shop.cart');
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
        $products = Product::with('category')->get();

        foreach ($products as $product) {
            $categoryName = $product->category->name;
            $categorySlug = $product->category->slug;
        }
        
        if($this->orderBy == 'Price: Low to High') 
        {
            $products = Product::whereBetween('regular_price',[$this->min_value,$this->max_value])->orderBy('regular_price', 'ASC')->paginate($this->pageSize);
        }
        else if($this->orderBy == 'Price: High to Low') 
        {
            $products = Product::whereBetween('regular_price',[$this->min_value,$this->max_value])->orderBy('regular_price', 'DESC')->paginate($this->pageSize);
        }
        else if($this->orderBy == 'Sort by Newness') 
        {
            $products = Product::whereBetween('regular_price',[$this->min_value,$this->max_value])->orderBy('created_at', 'ASC')->paginate($this->pageSize);
        }
        else
        {
            $products = Product::whereBetween('regular_price',[$this->min_value,$this->max_value])->paginate($this->pageSize);
        }
        $categories = Category::orderBy('name','ASC')->get(); 
        return view('livewire.shop-component',['products'=>$products, 'categories'=>$categories]);
    }
}
