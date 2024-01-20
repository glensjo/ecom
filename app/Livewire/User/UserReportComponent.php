<?php

namespace App\Livewire\User;

use App\Models\Order;
use Livewire\Component;

class UserReportComponent extends Component
{
    public function render()
    {
        $orders = Order::orderBy('created_at','ASC')->paginate(5);
        return view('livewire.user.user-report-component', ['orders'=> $orders]);
    }
}
