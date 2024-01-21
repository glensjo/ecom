<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class GenerateReportComponent extends Component
{
    public function render()
    {
        if (auth()->user()->utype=='ADM')
        $orders = Order::orderBy('created_at','ASC')->paginate(5);
        else
        $orders = Order::where(['user_id'=>auth()->user()->id])->orderBy('created_at','ASC')->paginate(5);
        return view('livewire.generate-report-component', ['orders'=> $orders]);
    }
}
