<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;

class CartIconComponent extends Component
{
    // protected $listeners = ['updateCartItemCount' => 'cartItemCount'];
    public $total = 0;

    public function cartItemCount()
    {
        if(auth()->user()){
        $this->total = Cart::whereUserId(auth()->user()->id)->count();
        }
    }

    public function render()
    {
        $this->cartItemCount();
        return view('livewire.cart-icon-component');
    }
}
