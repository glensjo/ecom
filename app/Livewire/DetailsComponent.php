<?php

namespace App\Livewire;

use App\Models\Cart as CartModel;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithFileUploads;
use Session;

class DetailsComponent extends Component
{
    use WithFileUploads;
    public $slug;
    public $size;
    public $custom_description;
    public $design_image;
    public $category_id;
    public $product_id;
    public $user_id;
    public $qty;
    
    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function addCart()
    {
        $prod = Product::where("slug", $this->slug)->first();
        $this->validate([
            'size' => 'required',
            'qty'=> 'required',
            'custom_description' => 'required',
            'design_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048' // Adjust the max size as neede
        ]);
        $cart= new CartModel();
        $cart->size=$this->size;
        $cart->qty=$this->qty;
        $cart->custom_description=$this->custom_description;
        $imageName = Carbon::now()->timestamp.'.'.$this->design_image->getClientOriginalName();
        $this->design_image->storeAs('designs', $imageName);
        $cart->design_image = $imageName;
        $cart->product_id=$prod->id;
        $cart->user_id=auth()->user()->id;
        $cart->save();
        
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('shop.cart');
    }

    public function render()
    {
        $product = Product::where("slug", $this->slug)->first();
        $rproducts = Product::where("category_id", $product->category_id)->inRandomOrder()->limit(4)->get();
        $categories = Category::orderBy('name','ASC')->get(); 
        return view('livewire.details-component',['product'=> $product, 'rproducts'=> $rproducts, 'categories'=> $categories, 'cartItems' => Cart::content()]);
    }
}






