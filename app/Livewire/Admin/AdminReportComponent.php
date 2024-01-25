<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Barryvdh\DomPDF\Facade as PDF;

class AdminReportComponent extends Component
{
    public function generatePDF()
    {
        // return redirect()->route('generate');
        // if (auth()->user()->utype=='ADM')
        // $orders = Order::orderBy('created_at','ASC')->paginate(5);
        // else
        // $orders = Order::where(['user_id'=>auth()->user()->id])->orderBy('created_at','ASC')->paginate(5);
        $htmlContent = view('livewire.generate-report-component')->render(); // Replace with your view

        $pdf = SnappyPdf::loadHTML($htmlContent);
        return $pdf->download('document.pdf');
    }
    public function render()
    {
        $orders = Order::orderBy('created_at','ASC')->paginate(5); 
        return view('livewire.admin.admin-report-component', ['orders'=> $orders]);
    }

    // public function generatePDF()
    // {
    //     $pdf = PDF::loadView('livewire.generate-report-component');
    //     return $pdf->download('report.pdf');
    // }
}
