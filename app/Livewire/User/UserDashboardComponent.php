<?php

namespace App\Livewire\User;

use App\Models\Order;
use Livewire\Component;

class UserDashboardComponent extends Component
{
    public $orders;
    public function render()
    {
        $this->orders = Order::where(['user_id'=>auth()->user()->id])
                ->get();
        return view('livewire.user.user-dashboard-component');
    }
}
