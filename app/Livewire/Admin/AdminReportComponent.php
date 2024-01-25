<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Order;
use Livewire\Component;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Symfony\Component\Console\Output\ConsoleOutput;

class AdminReportComponent extends Component
{
    public $startdate, $enddate, $category_id;
    public $sub_total=0, $tax=0, $total=0;

    // public function generatePDF()
    // {
    //     // return redirect()->route('generate');
    //     // if (auth()->user()->utype=='ADM')
    //     // $orders = Order::orderBy('created_at','ASC')->paginate(5);
    //     // else
    //     // $orders = Order::where(['user_id'=>auth()->user()->id])->orderBy('created_at','ASC')->paginate(5);
    //     $htmlContent = view('livewire.generate-report-component')->render(); // Replace with your view

    //     $pdf = SnappyPdf::loadHTML($htmlContent);
    //     return $pdf->download('document.pdf');
    // }
    public function render()
    {
        $categories = Category::orderBy("name","ASC")->get();
        return view('livewire.admin.admin-report-component', compact('categories'));
    }

    public function generatePDF()
    {
        $output = new ConsoleOutput();

        $startdate = $this->startdate;
        $enddate = $this->enddate;
        $category_id = $this->category_id;
        $this->total = 0;
        $this->tax = 0;
        $this->sub_total = 0;

        if (auth()->user()->utype=='ADM') 
            //semua kosong
            if($startdate=='' && $enddate=='' && $category_id=='') {
                $orders = Order::orderBy('created_at','ASC')->paginate();
                foreach($orders as $item) 
                {
                    $this->sub_total += $item->product->regular_price * $item->qty;
                }
                $this->tax = $this->sub_total * 0.1;
                $this->total = $this->sub_total + $this->tax;
            }
            //ada start date
            elseif($startdate!='' && $enddate=='' && $category_id=='') {
                $orders = Order::where('created_at', 'LIKE', '%' . $startdate . '%')
                        ->orderBy('created_at', 'ASC')
                        ->paginate();
                foreach($orders as $item) 
                {
                    $this->sub_total += $item->product->regular_price * $item->qty;
                }
                $this->tax = $this->sub_total * 0.1;
                $this->total = $this->sub_total + $this->tax;
            }
            //ada end date
            elseif($startdate=='' && $enddate!='' && $category_id=='') {
                $orders = Order::where('created_at', 'LIKE', '%' . $enddate . '%')
                        ->orderBy('created_at', 'ASC')
                        ->paginate();
                foreach($orders as $item) 
                {
                    $this->sub_total += $item->product->regular_price * $item->qty;
                }
                $this->tax = $this->sub_total * 0.1;
                $this->total = $this->sub_total + $this->tax;
            }
            //ada category
            elseif($startdate=='' && $enddate=='' && $category_id!='') {
                $orders = Order::join('products', 'orders.product_id', '=', 'products.id')
                        ->where('products.category_id', $category_id)
                        ->orderBy('orders.created_at', 'ASC')
                        ->paginate();
                foreach($orders as $item) 
                {
                    $this->sub_total += $item->product->regular_price * $item->qty;
                }
                $this->tax = $this->sub_total * 0.1;
                $this->total = $this->sub_total + $this->tax;
            }
            //ada start date and end date
            elseif($startdate!='' && $enddate!='' && $category_id=='') {
                $orders = Order::whereBetween('created_at', [$startdate, $enddate])
                        ->orderBy('created_at', 'ASC')
                        ->paginate();
                foreach($orders as $item) 
                {
                    $this->sub_total += $item->product->regular_price * $item->qty;
                }
                $this->tax = $this->sub_total * 0.1;
                $this->total = $this->sub_total + $this->tax;
            }
            //ada start date and category
            elseif($startdate!='' && $enddate=='' && $category_id!='') {
                $orders = Order::where('orders.created_at', 'LIKE', '%' . $startdate . '%')
                        ->join('products', 'orders.product_id', '=', 'products.id')
                        ->where('products.category_id', $category_id)
                        ->orderBy('orders.created_at', 'ASC')
                        ->paginate();
                foreach($orders as $item) 
                {
                    $this->sub_total += $item->product->regular_price * $item->qty;
                }
                $this->tax = $this->sub_total * 0.1;
                $this->total = $this->sub_total + $this->tax;
            }
            //ada end date and category
            elseif($startdate=='' && $enddate!='' && $category_id!='') {
                $orders = Order::where('orders.created_at',  'LIKE', '%' . $enddate . '%')
                        ->join('products', 'orders.product_id', '=', 'products.id')
                        ->where('products.category_id', $category_id)
                        ->orderBy('orders.created_at', 'ASC')
                        ->paginate();
                foreach($orders as $item) 
                {
                    $this->sub_total += $item->product->regular_price * $item->qty;
                }
                $this->tax = $this->sub_total * 0.1;
                $this->total = $this->sub_total + $this->tax;
            }
            //ada start date, end date, category
            elseif($startdate!='' && $enddate!='' && $category_id!='') {
                $orders = Order::whereBetween('orders.created_at', [$startdate, $enddate])
                    ->join('products', 'orders.product_id', '=', 'products.id')
                    ->where('products.category_id', $category_id)
                    ->orderBy('orders.created_at', 'ASC')
                    ->paginate();

                foreach($orders as $item) 
                {
                    $this->sub_total += $item->product->regular_price * $item->qty;
                }
                $this->tax = $this->sub_total * 0.1;
                $this->total = $this->sub_total + $this->tax;
            }
            else
            session()->flash('message','No transactions record!');
        
        else
            $orders = Order::where(['user_id'=>auth()->user()->id])->orderBy('created_at','ASC')->paginate(5);

        $output->writeln($orders);

        if ($orders->count() > 0) {
            $pdf = PDF::loadView('livewire.generate-report-component', ['orders'=> $orders, 'sub_total' => $this->sub_total, 'tax' => $this->tax, 'total' => $this->total]);
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
                }, 'invoice.pdf');
        }
        else
            session()->flash('message','No transactions record!');
    }
}
