<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Output\ConsoleOutput;

class AdminOrderComponent extends Component
{
    use WithPagination;
    public $order_id, $status, $reason;

    public function updateStatus()
    {
        $output = new ConsoleOutput();
        $output->writeln($this->order_id);
        $output->writeln($this->status);
        
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
        $orderr->save();
        session()->flash('message','Reason has been added!');
    }

    public function render()
    {
        $orders = Order::with('transaction')->get();
        $orders = Order::orderBy('created_at','ASC')->paginate(5);

        return view('livewire.admin.admin-order-component', ['orders'=> $orders]);
    }
}
