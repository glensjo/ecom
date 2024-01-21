<?php

namespace App\Livewire\User;

use App\Models\Order;
use Livewire\Component;

class UserReportComponent extends Component
{
    public function generateReport()
    {
        return redirect()->route('generate');
    }

    public function render()
    {
        $orders = Order::where(['user_id'=>auth()->user()->id])->orderBy('created_at','ASC')->paginate(5);
        return view('livewire.user.user-report-component', ['orders'=> $orders]);
    }
}
