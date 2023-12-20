<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditProductComponent extends Component
{
    use WithFileUploads;
    public $product_id;
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $image;
    public $category_id;
    public $newImage;

    public function mount($product_id)
    {
        $product = Product::find($product_id);
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->regular_price = $product->regular_price;
        $this->image = $product->image;
        $this->category_id = $product->category_id;
    }
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function editProduct()
    {
        $this->validate([
            "name"=> "required",
            "slug"=> "required",
            "short_description"=> "required",
            "description"=> "required",
            "regular_price"=> "required",
            "image"=> "required",
            "category_id"=> "required"
        ]);
        $product = Product::find( $this->product_id );
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        if ($this->newImage) 
        {
            unlink('assets/imgs/products/'.$product->image);
            $imageName = Carbon::now()->timestamp.'.'.$this->newImage->getClientOriginalExtension();
            $this->newImage->storeAs('products', $imageName);
            $product->image = $imageName;
        }
        $product->category_id = $this->category_id;
        $product->save();
        session()->flash('message','Product has been updated!');
    }

    public function render()
    {
        $categories = Category::orderBy("name","ASC")->get();
        return view('livewire.admin.admin-edit-product-component', ['categories'=> $categories]);
    }
}
