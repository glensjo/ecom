<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class AdminReportController extends Component
{
    use WithPagination;
    public $orders;
    public $order_id, $status;
    public $options;

    public function generate()
    {
        $this->validate([
            "startdate"=> "",
            "enddate"=> "",
            "category_id"=> ""
        ]);
        $order = Order::find($this->order_id);
        $order->startdate = $this->startdate;
        $order->enddate = $this->enddate;
        $order->startdate = $this->startdate;
        session()->flash('message','Generating your reports!');
    }

    public function render()
    {
        $orders = Order::all();

        if($this->startdate)
        return view('livewire.admin.admin-report-controller');
    }
}
