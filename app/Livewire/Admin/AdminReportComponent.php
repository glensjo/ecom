<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;

class AdminReportComponent extends Component
{
    public function generateReport()
    {
        return redirect()->route('generate');
    }
    public function render()
    {
        $orders = Order::orderBy('created_at','ASC')->paginate(5); 
        return view('livewire.admin.admin-report-component', ['orders'=> $orders]);
    }
}
