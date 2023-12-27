<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;

class CartIconComponent extends Component
{
    // protected $listeners = ['updateCartItemCount' => 'cartItemCount'];
    public $total = 0;
    public $carts;

    public function cartItemCount()
    {
        $this->total = Cart::whereUserId(auth()->user()->id)->count();
    }

    public function render()
    {
        if(auth()->user()){
            $this->carts = Cart::with('product')
                    ->where(['user_id'=>auth()->user()->id])
                    ->get();
            $this->cartItemCount();
        }
        return view('livewire.cart-icon-component');
    }
}
