<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartComponent extends Component
{
    public function increaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId, $qty);
        // $this->emitTo('cart-icon-component','refreshComponent');
        return redirect('/cart');
    }

    public function decreaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId, $qty);
        // $this->emitTo('cart-icon-component','refreshComponent');
        return redirect('/cart');
    }

    public function destroy($id)
    {
        Cart::remove($id);
        // $this->emitTo('cart-icon-component','refreshComponent');
        session()->flash("success_message","Item has been removed!");
        return redirect('/cart');
    }

    public function clearAll()
    {
        Cart::destroy();   
        // $this->emitTo('cart-icon-component','refreshComponent');  
        return redirect('/cart');   
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
