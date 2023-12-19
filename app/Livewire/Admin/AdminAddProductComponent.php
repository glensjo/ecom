<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $image;
    public $category_id;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function addProduct()
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
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $imageName = Carbon::now()->timestamp.'.'.$this->image->getClientOriginalExtension();
        $this->image->storeAs('products', $imageName);
        $product->image = $imageName;
        $product->category_id = $this->category_id;
        $product->save();
        session()->flash('message','Product has been added!');
    }

    public function render()
    {
        $categories = Category::orderBy("name","ASC")->get();
        return view('livewire.admin.admin-add-product-component', compact('categories'));
    }
}
