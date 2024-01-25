<div>
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display: block;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Reports
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    Reports
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <button wire:click="generatePDF">Generate PDF</button>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Design</th>
                                        <th style="width: 15%">Custom Description</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = ($orders->currentPage()-1)*$orders->perPage();
                                    @endphp
                                    @foreach ($orders as $order)
                                        <tr>
                                            {{-- <td>{{$order->user->name}} </td> --}}
                                            <td>{{++$i}} </td>
                                            <td>{{$order->product->name}} </td>
                                            <td><img src="{{ asset('assets/imgs/designs') }}/{{$order->design_image}}" alt="{{$order->user->name}}" width="60"></td>
                                            <td>{{$order->custom_description}} </td>
                                            <td>{{$order->size}} </td>
                                            <td>{{$order->qty}} </td>
                                            <td><img src="{{ asset('assets/imgs/paymentValidations') }}/{{$order->payment_image}}" alt="{{$order->user->name}}" width="60"></td>
                                            <td>
                                                Current status : {{$order->status}} <br>
                                                @if($order->status=="Order Rejected" && $order->reason!="")
                                                Reason : {{$order->reason}}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$orders->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
