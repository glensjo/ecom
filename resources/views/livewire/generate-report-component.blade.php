<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Invoice Template</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

    body {
    font-size: 16px;
    margin: 20px;
    }
    
    table {
    width: 100%;
    border-collapse: collapse;
    }
    
    table tr td {
    padding: 0;
    }
    
    table tr td:last-child {
    text-align: right;
    }
    
    .bold {
    font-weight: bold;
    }
    
    .right {
    text-align: right;
    }
    
    .large {
    font-size: 1.75em;
    }
    
    .total {
    font-weight: bold;
    color: #fb7578;
    }
    
    .logo-container {
    margin: 20px 0 70px 0;
    }
    
    .invoice-info-container {
    font-size: 0.875em;
    }
    .invoice-info-container td {
    padding: 4px 0;
    }
    
    .client-name {
    font-size: 1.5em;
    vertical-align: top;
    }
    
    .line-items-container {
    margin: 70px 0;
    font-size: 0.875em;
    }
    
    .line-items-container th {
    text-align: left;
    color: #999;
    border-bottom: 2px solid #ddd;
    padding: 10px 0 15px 0;
    font-size: 0.75em;
    text-transform: uppercase;
    }
    
    .line-items-container th:last-child {
    text-align: right;
    }
    
    .line-items-container td {
    padding: 15px 0;
    }
    
    .line-items-container tbody tr:first-child td {
    padding-top: 25px;
    }
    
    .line-items-container.has-bottom-border tbody tr:last-child td {
    padding-bottom: 25px;
    border-bottom: 2px solid #ddd;
    }
    
    .line-items-container.has-bottom-border {
    margin-bottom: 0;
    }
    
    .line-items-container th.heading-quantity {
    width: 50px;
    }
    .line-items-container th.heading-price {
    text-align: right;
    width: 100px;
    }
    .line-items-container th.heading-subtotal {
    width: 100px;
    }
    
    .payment-info {
    width: 38%;
    font-size: 0.75em;
    line-height: 1.5;
    }
    
    .footer {
    margin-top: 100px;
    }
    
    .footer-thanks {
    font-size: 1.125em;
    }
    
    .footer-thanks img {
    display: inline-block;
    position: relative;
    top: 1px;
    width: 16px;
    margin-right: 4px;
    }
    
    .footer-info {
    float: right;
    margin-top: 5px;
    font-size: 0.75em;
    color: #ccc;
    }
    
    .footer-info span {
    padding: 0 5px;
    color: black;
    }
    
    .footer-info span:last-child {
    padding-right: 0;
    }
    
    .page-container {
    display: none;
    }

    .footer {
    margin-top: 30px;
    }

    .footer-info {
    float: none;
    position: running(footer);
    margin-top: -25px;
    }

    .page-container {
    display: block;
    position: running(pageContainer);
    margin-top: -25px;
    font-size: 12px;
    text-align: right;
    color: #999;
    }

    .page-container .page::after {
    content: counter(page);
    }

    .page-container .pages::after {
    content: counter(pages);
    }


    @page {
    @bottom-right {
        content: element(pageContainer);
    }
    @bottom-left {
        content: element(footer);
    }
    }
</style>
</head>

<body>
<div class="web-container">  
{{-- <table class="invoice-info-container">
    <tr>
    <td rowspan="2" class="client-name">User Name : {{auth()->user()->name}}</td>
    <td class="client-name"><strong>Cigem Creative</strong></td>
    </tr>
    <tr>
    <td>
        Toko Bangunan Pusaka / Konveksi, Jl. Bintaro Permai Gang Samping No.56, RT.4/RW.2 <br>
        Pesanggrahan, Kec. Pesanggrahan, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta, 12320
    </td>
    </tr>
    <tr>
    <td>
        Invoice Date: <strong>May 24th, 2024</strong>
    </td><td></td>
    </tr>
    <tr>
    <td>
        Invoice No: <strong>12345</strong>
    </td>
    <td>cigem.creative@gmail.com</td>
    </tr>
</table>

<table class="line-items-container">
    <thead>
        <tr class="table-primary">   
            <th class="text-center" style="width: 3%">#</th>
            <th class="text-center" style="width: 17%">Product Name</th>
            <th class="text-center">Design</th>
            <th class="text-center" style="width: 35%">Custom Description</th>
            <th class="text-center" style="width: 5%">Size</th>
            <th class="text-center" style="width: 5%">Qty</th>
            <th class="text-center">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td class="text-center">{{$loop->iteration}} </td>
                <td class="text">{{$order->product->name}} </td>
                <td class="text-center"><img src="{{ asset('assets/imgs/designs') }}/{{$order->design_image}}" alt="{{$order->user->name}}" width="60"></td>
                <td class="text-center">{{$order->custom_description}} </td>
                <td class="text-center">{{$order->size}} </td>
                <td class="text-center">{{$order->qty}} </td>
                <td class="text-center bold">{{$order->status}}<br>                                                
                    @if($order->status=="Order Rejected" && $order->reason!="")
                    Reason : {{$order->reason}}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


<table class="line-items-container has-bottom-border" style="align-items: right">
    <thead>
    <tr>
        <th>Subtotal</th>
        <th>Tax</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="large">Rp {{ number_format($order->subtotal, 3, '.', '.') }}
        </td>
        <td class="large">Rp {{ number_format($order->tax, 3, '.', '.') }}</td>
        <td class="large total">Rp {{ number_format($order->total, 3, '.', '.') }} </td>
    </tr>
    </tbody>
</table> --}}

<div class="footer">
    <div class="footer-info">
    <span>hello@useanvil.com</span> |
    <span>555 444 6666</span> |
    <span>useanvil.com</span>
    </div>
    <div class="footer-thanks">
    <span>Thank you!</span>
    </div>
</div>

</div>


</body></html>