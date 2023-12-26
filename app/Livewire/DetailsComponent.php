<?php

namespace App\Livewire;

use App\Models\Cart as CartModel;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Session;

class DetailsComponent extends Component
{
    use WithFileUploads;
    public $slug;
    // public $products;
    // public $selected_size;
    // public $description;
    // public $design_image;
    // public $product_id;
    // public $custom_description;
    // // public $quantity = 1; // Default quantity
    // public array $quantity = [];

    public $selected_size;
    public $custom_description;
    public $design_image;
    public $category_id;
    public $product_id;
    public $user_id;
    public $quantity = 1;

    public $prod;


    public function mount($slug)
    {
        $this->slug = $slug;
        // $this->products = Product::all();
        // foreach($this->products as $prod)
        // {
        //     $this->quantity[$prod->id] = 1;
        // }
    }

    public function mountt($productId)
    {
        
        $this->prod = Product::find($productId);

        // if (!$this->product) {
        //     abort(404); // Atau cara menangani produk tidak ditemukan sesuai kebutuhan aplikasi Anda
        // }
    }

    // public function store($product_id, $product_name, $product_price)
    // {
    //     Cart::add($product_id, $product_name, 3, $product_price)->associate('\App\Models\Product');
    //     session()->flash('success_message','Item added in Cart');
    //     return redirect()->route('shop.cart');
    // }

    // public function store(Request $request, $product_id, $product_name, $product_price)
    // {
    //     $size = $request->input('size');
    //     $description = $request->input('description');
    //     $design_image = $request->file('design_image'); // Assuming it's a file upload

    //     Cart::add($product_id, $product_name, 3, $product_price, [
    //         'size' => $size,
    //         'description' => $description,
    //         'design_image' => $design_image,
    //     ])->associate('\App\Models\Product');

    //     session()->flash('success_message', 'Item added in Cart');
    //     return redirect()->route('shop.cart');
    // }


    // public function storeCart($product_id)
    // {
    //     $cart = Product::findOrFail($product_id);
    //     Cart::add(
    //         $cart->id,
    //         $cart->name,
    //         $cart->price,
    //         $this->quantity[$product_id],
    //         // $request->input('custom_description'),
    //         // $request->input('size'),
    //         $imageName = Carbon::now()->timestamp.'.'.$this->design_image->getClientOriginalExtension(),
    //         $this->design_image->storeAs('designs', $imageName),
    //         $cart->design_image = $imageName
    //     );
    // }

    // public function addCart()
    // {
    //     // Validate form fields, including image upload if necessary

    //     // Save the image to the storage disk and get the path
    //     $imagePath = $this->design_image->store('design_images', 'public');

    //     // Add the product to the shopping cart with image path in options
    //     Cart::add([
    //         'id' => $this->product_id,
    //         'name' => 'Product Name', // Replace with your product name
    //         'qty' => $this->quantity,
    //         'price' => 10, // Replace with your product price
    //         'options' => [
    //             'user_id' => Auth::user()->id,
    //             'design_image' => $imagePath,
    //             'size' => $this->selected_size,
    //             // Update to use $this->custom_description
    //             'custom_description' => $this->custom_description,
    //             // Add other options as needed
    //         ],
    //     ]);

    //     // Clear the form fields after adding to the cart
    //     $this->resetForm();
    // }

    // private function resetForm()
    // {
    //     $this->selected_size = '';
    //     $this->description = '';
    //     $this->design_image = null;
    //     $this->product_id = '';
    //     $this->quantity = 1;
    // }

    public function addToCart()
    {
        // Logika penambahan ke keranjang belanja di sini
        $cart = Session::get('cart', []);

        $item = [
            'product_id' => $this->prod->id,
            'name' => $this->prod->name,
            'size' => $this->prod->size,
            'qty' => $this->prod->qty,
            'custom_description' => $this->prod->custom_description,
            // 'design_image' => $this->design_image ? $this->design_image->store('design_image', 'public') : null,
        ];

        $cart[] = $item;

        Session::put('cart', $cart);

        // Clear input setelah ditambahkan ke keranjang
        // $this->reset(['product.size', 'product.qty', 'product.custom_description', 'design_image']);
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('shop.cart');
    }

    // public function storeCart()
    // {
    //     foreach (Cart::content() as $item) {
    //         CartModel::create([
    //             'product_name' => $item->name,
    //             'product_id' => $item->id,
    //             'quantity' => $item->qty,
    //             'price' => $item->price,
    //             // Add more columns as needed
    //         ]);
    //     }

    //     // Clear the cart after storing in the database
    //     Cart::destroy();
    //     session()->flash('success_message','Item added in Cart');
    //     return redirect()->route('shop.cart');
    // }

    // public function addCart()
    // {
    //     $this->validate([
    //         'selected_size' => 'required',
    //         'description' => 'required',
    //         'image' => 'required|image|max:2048', // Adjust the max size as needed
    //     ]);
    //     $cart = new Cart();
    //     $cart->selected_size = $this->selected_size;
    //     $cart->custom_description = $this->custom_description;
    //     $imageName = Carbon::now()->timestamp.'.'.$this->image->getClientOriginalExtension();
    //     $this->image->storeAs('designs', $imageName);
    //     $cart->image = $imageName;
    //     $cart->product_id = $this->product_id;
    //     $cart->user_id = Auth::user()->id;
    //     $cart->quantity = $this->quantity;
    //     $cart->save();
    //     session()->flash('success_message','Item added in Cart');
    //     return redirect()->route('shop.cart');
    // }

    public function render()
    {
        $product = Product::where("slug", $this->slug)->first();
        $rproducts = Product::where("category_id", $product->category_id)->inRandomOrder()->limit(4)->get();
        $categories = Category::orderBy('name','ASC')->get(); 
        return view('livewire.details-component',['product'=> $product, 'rproducts'=> $rproducts, 'categories'=> $categories, 'cartItems' => Cart::content()]);
    }
}






