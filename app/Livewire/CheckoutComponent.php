<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithFileUploads;

class CheckoutComponent extends Component
{
    use WithFileUploads;
    public $carts, $sub_total = 0, $total = 0, $tax = 0;
    public $payment_image, $status, $company;

    public function placeOrder()
    {
        $itemcart = Cart::with('product')
                ->where(['user_id'=>auth()->user()->id])
                ->get();
        $this->validate([
            'payment_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048' // Adjust the max size as neede
        ]);
        
        foreach ($itemcart as $item) {
            $order= new Order();
            $order->size=$item->size;
            $order->qty=$item->qty;
            $order->custom_description=$item->custom_description;
            $order->design_image = $item->design_image;
            $order->company = $this->company;
            $order->subtotal = $this->sub_total;
            // dd($order->company);
            $order->tax = $this->tax;
            $order->total = $this->total;
            $imageName = auth()->user()->id.'.'.$this->payment_image->getClientOriginalName();
            $this->payment_image->storeAs('paymentValidations', $imageName);
            $order->payment_image = $imageName;
            $order->status = "Waiting";
            $order->product_id=$item->product->id;
            $order->user_id=auth()->user()->id;
            $order->save();
        }

        $cart = Cart::with('product')
                ->where(['user_id'=>auth()->user()->id])
                ->get();
        foreach ($cart as $item) {
            $item->delete();            
        }

        session()->flash('success_message','Order Placement');
        return $this->redirect('/user/orders');
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
        return view('livewire.checkout-component');
    }
}
