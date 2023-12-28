<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class AdminOrderComponent extends Component
{
    use WithPagination;
    public $orders;
    public function render()
    {
        $this->orders = Order::get();
        return view('livewire.admin.admin-order-component');
    }
}
