<?php

namespace App\Livewire\User;

use App\Models\Order;
use App\Models\Transaction;
use Livewire\Component;

class UserDashboardComponent extends Component
{
    public $orders;
    public function render()
    {
        $transactions = Transaction::where(['user_id' => auth()->user()->id])
        ->with('orders') 
        ->get();

        // Filter transactions where all orders are not marked as "Done"
        $transactions = $transactions->filter(function ($transaction) {
            foreach ($transaction->orders as $order) {
                if ($order->status !== 'Done') {
                    return true;
                }
            }
            return false;
        });

        return view('livewire.user.user-dashboard-component', [
            'transactions' => $transactions,
        ]);
    }
}
