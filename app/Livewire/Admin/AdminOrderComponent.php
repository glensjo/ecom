<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class AdminOrderComponent extends Component
{
    use WithPagination;
    public $orders;
    public $order_id, $status;
    public $options;

    public function updateStatus()
    {
        $this->validate([
            "status"=> "required"
        ]);
        $order = Order::find($this->order_id);
        $order->status = $this->status;
        $order->save();
        session()->flash('message','Status has been updated successfully!');
    }

    public function render()
    {
        $this->orders = Order::get();
        $this->options = ['Confirmed Payment', 'Rejected Order', 'In Progress', 'Ready To Pick Up','Done'];
        return view('livewire.admin.admin-order-component');
    }
}
