<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Cart as CartModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartCheckout extends Component
{
    public function render()
    {
        return view('livewire.cart-checkout');
    }

    public function checkout()
    {
        $cartItems = Cart::content();

        foreach ($cartItems as $cartItem) 
        {
            CartModel::create([
                'user_id'=>Auth::user()->id,
                'product_id'=> $cartItem->id,
                'quantity'=> $cartItem->qty,
            ]);
        }

        Cart::destroy();

        session()->flash('success','Checkout Succed!!');
        return redirect()->route('checkout.success');
    }

    

}
