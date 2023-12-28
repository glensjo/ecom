<?php

namespace App\Livewire;

// use Gloudemans\Shoppingcart\Facades\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartComponent extends Component
{
    public $carts, $sub_total = 0, $total = 0, $tax = 0;
    protected $debug = true;
    public function increaseQuantity($id)
    {
        $cart = Cart::whereId($id)->first();
        $cart->qty += 1;
        $cart->save();
        session()->flash("success_message","Item quantity has been updated!!");
        return redirect('/cart');
    }

    public function decreaseQuantity($id)
    {
        $cart = Cart::whereId($id)->first();
        if ($cart->qty > 1) {            
            $cart->qty -= 1;
            $cart->save();
            session()->flash("success_message","Item quantity has been updated!!");
        } else {
            session()->flash("info","You cannot have less than 1!!");
        }
        return redirect('/cart');
    }

    public function destroy($id)
    {
        $cart = Cart::whereId($id)->first();
        if ($cart) {
            $cart->delete();            
        }
        
        session()->flash("success_message","Item has been removed!!");
        return redirect('/cart');
    }

    public function clearAll()
    {
        $cart = Cart::with('product')
                ->where(['user_id'=>auth()->user()->id])
                ->get();
        foreach ($cart as $item) {
            $item->delete();            
        }
        session()->flash("success_message","All item removed!!");
        return redirect('/cart');   
    }

    public function render()
    {
        $this->carts = Cart::with('product')
                ->where(['user_id'=>auth()->user()->id])
                ->get();
        $this->total = 0;
        $this->tax = 0;
        $this->sub_total = 0;

        foreach($this->carts as $item) 
        {
            $this->sub_total += $item->product->regular_price * $item->qty;
        }
        $this->tax = $this->sub_total * 0.1;
        $this->total = $this->sub_total + $this->tax;
        return view('livewire.cart-component');
    }
}
