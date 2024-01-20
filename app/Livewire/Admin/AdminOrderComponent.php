<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class AdminOrderComponent extends Component
{
    use WithPagination;
    public $orders;
    public $order_id, $status, $reason;

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

    public function addReason()
    {
        $this->validate([
            "reason"=> "required|string"
        ]);
        $orderr = Order::find($this->order_id);
        $orderr->reason = $this->reason;
        // dd( $order->reason);
        $orderr->save();
        session()->flash('message','Reason has been added!');
    }

    public function render()
    {
        $this->orders = Order::get();
        return view('livewire.admin.admin-order-component');
    }
}
