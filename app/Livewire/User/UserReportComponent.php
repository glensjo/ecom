<?php

namespace App\Livewire\User;

use App\Models\Category;
use App\Models\Order;
use App\Models\Transaction;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Symfony\Component\Console\Output\ConsoleOutput;

class UserReportComponent extends Component
{
    public $startdate, $enddate, $category_id;
    public $sub_total=0, $tax=0, $total=0;
    public function filter()
    {
        $startdate = $this->startdate;
        $enddate = $this->enddate;
        $category_id = $this->category_id;

        if (auth()->user()->utype=='USR') 
            //semua kosong
            if($startdate=='' && $enddate=='' && $category_id=='') {
                $orders = Transaction::where(['user_id'=>auth()->user()->id])->orderBy('created_at','ASC')->paginate();
            }
            //ada start date
            elseif($startdate!='' && $enddate=='' && $category_id=='') {
                $orders = Transaction::where(['user_id'=>auth()->user()->id])
                        ->where('created_at', 'LIKE', '%' . $startdate . '%')
                        ->orderBy('created_at', 'ASC')
                        ->paginate();
            }
            //ada end date
            elseif($startdate=='' && $enddate!='' && $category_id=='') {
                $orders = Transaction::where(['user_id'=>auth()->user()->id])
                        ->where('created_at', 'LIKE', '%' . $enddate . '%')
                        ->orderBy('created_at', 'ASC')
                        ->paginate();
            }
            //ada category
            elseif($startdate=='' && $enddate=='' && $category_id!='') {
                $orders = Transaction::where(['user_id'=>auth()->user()->id])
                        ->join('products', 'orders.product_id', '=', 'products.id')
                        ->where('products.category_id', $category_id)
                        ->orderBy('orders.created_at', 'ASC')
                        ->paginate();
            }
            //ada start date and end date
            elseif($startdate!='' && $enddate!='' && $category_id=='') {
                $orders = Transaction::where(['user_id'=>auth()->user()->id])
                        ->whereBetween('created_at', [$startdate, $enddate])
                        ->orderBy('created_at', 'ASC')
                        ->paginate();
            }
            //ada start date and category
            elseif($startdate!='' && $enddate=='' && $category_id!='') {
                $orders = Transaction::where(['user_id'=>auth()->user()->id])
                        ->where('orders.created_at', 'LIKE', '%' . $startdate . '%')
                        ->join('products', 'orders.product_id', '=', 'products.id')
                        ->where('products.category_id', $category_id)
                        ->orderBy('orders.created_at', 'ASC')
                        ->paginate();
            }
            //ada end date and category
            elseif($startdate=='' && $enddate!='' && $category_id!='') {
                $orders = Transaction::where(['user_id'=>auth()->user()->id])
                        ->where('orders.created_at',  'LIKE', '%' . $enddate . '%')
                        ->join('products', 'orders.product_id', '=', 'products.id')
                        ->where('products.category_id', $category_id)
                        ->orderBy('orders.created_at', 'ASC')
                        ->paginate();
            }
            //ada start date, end date, category
            elseif($startdate!='' && $enddate!='' && $category_id!='') {
                $orders = Transaction::where(['user_id'=>auth()->user()->id])
                        ->whereBetween('orders.created_at', [$startdate, $enddate])
                        ->join('products', 'orders.product_id', '=', 'products.id')
                        ->where('products.category_id', $category_id)
                        ->orderBy('orders.created_at', 'ASC')
                        ->paginate();
            }
            else
            session()->flash('message','No transactions detected!');

        else
            session()->flash('message','You are Admin!');
    }

    public function generatePDF($transactionId)
    {
        // $output = new ConsoleOutput();

        $transaction = Transaction::findOrFail($transactionId);
        $orders = Order::where('transaction_id', $transactionId)->get();

        // $output->writeln($orders);

        if ($orders->count() > 0) {
            $pdf = PDF::loadView('livewire.generate-report-component', ['orders'=> $orders, 'transaction' => $transaction]);
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
                }, 'invoice.pdf');
        }
        else
            session()->flash('message','No transactions record!');
    }

    public function render()
    {
        $categories = Category::orderBy("name","ASC")->get();

        $transactions = Transaction::where(['user_id' => auth()->user()->id])
        ->with('orders') 
        ->get();

        // Filter transactions where all orders are not marked as "Done"
        $transactions = $transactions->filter(function ($transaction) {
            foreach ($transaction->orders as $order) {
                if ($order->status === 'Done') {
                    return true;
                }
            }
            return false;
        });

        return view('livewire.user.user-report-component', compact('categories', 'transactions'));
    }
}
