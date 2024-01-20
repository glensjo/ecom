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
                                                @if ($order->status!="Done" && $order->status!="Order Rejected")
                                                <form wire:submit.prevent="updateStatus">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="mb-3 mt-3">
                                                            <p>Select Status:</p>
                                                            @if ($order->status=="Waiting")
                                                                <div class="d-flex flex-row">
                                                                    <input type="radio" id="confirm . {{$order->id}}" name="status" value="In Progress" style="height: 20px; width: 30px" wire:model="status" wire:click="$set('order_id', {{$order->id}})"><br>
                                                                    <label for="confirm . {{$order->id}}">Confirm Payment</label><br>
                                                                </div>
                                                                <div class="d-flex flex-row">
                                                                    <input type="radio" id="reject . {{$order->id}}" name="status" value="Order Rejected" style="height: 20px; width: 30px" wire:model="status" wire:click="$set('order_id', {{$order->id}})">
                                                                    <label for="reject . {{$order->id}}">Reject Order</label><br>
                                                                </div>
                                                            @elseif ($order->status=="In Progress")
                                                                <div class="d-flex flex-row">
                                                                    <input type="radio" id="ready . {{$order->id}}" name="status" value="Ready to Pick Up" style="height: 20px; width: 30px" wire:model="status" wire:click="$set('order_id', {{$order->id}})">
                                                                    <label for="ready . {{$order->id}}">Ready to Pick Up</label><br>
                                                                </div>
                                                            @elseif ($order->status=="Ready to Pick Up")
                                                                <div class="d-flex flex-row">
                                                                    <input type="radio" id="done . {{$order->id}}" name="status" value="Done" style="height: 20px; width: 30px" wire:model="status" wire:click="$set('order_id', {{$order->id}})">
                                                                    <label for="done . {{$order->id}}">Already Picked Up</label><br>
                                                                </div>
                                                            @else
                                                            @endif
                                                            @error('status')
                                                                <p class="text-danger">{{$message}} </p>
                                                            @enderror
                                                        </div>
                                                        <!-- Use wire:model for the $order_id property -->
                                                        <input type="hidden" wire:model="order_id">
                                                        <button type="submit" class="btn float-end">Update</button>
                                                    </div>
                                                </form>
                                                @elseif($order->status=="Order Rejected" && $order->reason=="")
                                                <form wire:submit.prevent="addReason">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="mb-3 mt-3">
                                                            <label for="reason . {{$order->id}}">Reason</label><br>
                                                            <input type="text" id="reason . {{$order->id}}" name="reason" wire:model="reason">
                                                            @error('reason')
                                                                <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                        </div>
                                                        <!-- Use wire:model for the $order_id property -->
                                                        <input type="hidden" wire:model="order_id">
                                                        <button type="submit" class="btn float-end">Submit</button>
                                                    </div>
                                                </form>
                                                @elseif($order->status=="Order Rejected" && $order->reason!="")
                                                Reason : {{$order->reason}}
                                                @else
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
