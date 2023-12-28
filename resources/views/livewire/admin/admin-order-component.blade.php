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
                    <span></span> Manage Orders
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
                                    Manage Orders
                                </div>
                                {{-- <div class="col-md-6">
                                    <a href="{{ route('admin.product.add') }}" class="btn btn-success float-end">Add New Product</a>
                                </div> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{Session::get('message')}} </div>
                            @endif
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Design</th>
                                        <th>Custom Description</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @php
                                        $i = ($orders->currentPage()-1)*$orders->perPage();
                                    @endphp --}}
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{$order->user->name}} </td>
                                            <td>{{$order->product->name}} </td>
                                            <td><img src="{{ asset('assets/imgs/designs') }}/{{$order->design_image}}" alt="{{$order->user->name}}" width="60"></td>
                                            <td>{{$order->custom_description}} </td>
                                            <td>{{$order->size}} </td>
                                            <td>{{$order->qty}} </td>
                                            <td><img src="{{ asset('assets/imgs/paymentValidations') }}/{{$order->payment_image}}" alt="{{$order->user->name}}" width="60"></td>
                                            <td>
                                                Current status : {{$order->status}}
                                                {{-- <form wire:submit.prevent="updateStatus">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="mb-3 mt-3">
                                                            <select name="status">
                                                                <option value="">Select Status</option>
                                                                @foreach($options as $option)
                                                                    <option value="{{ $option }}">{{ $option }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('status')
                                                                <p class="text-danger">{{$message}} </p>
                                                            @enderror
                                                        </div>
                                                        <input type="hidden" value="{{ $order->id }}">
                                                        <button type="submit" class="btn float-end">Update</button>
                                                    </div>
                                                </form> --}}

                                                {{-- <form wire:submit.prevent="updateStatus">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="mb-3 mt-3">
                                                            <p>Select Status:</p>
                                                            @foreach($options as $option)
                                                                    <input type="radio" id="{{$option}}" name="status" value="{{$option}}" wire:model="status">
                                                                    <label for="{{$option}}">{{$option}}</label><br>
                                                             @endforeach
                                                            @error('status')
                                                                <p class="text-danger">{{$message}} </p>
                                                            @enderror
                                                        </div>
                                                        <input type="hidden" value="{{ $order->id }}">
                                                        <button type="submit" class="btn float-end">Update</button>
                                                    </div>
                                                </form> --}}
                                                
                                                <form wire:submit.prevent="updateStatus">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="mb-3 mt-3">
                                                            <p>Select Status:</p>
                                                            {{-- @foreach($options as $option)
                                                                <input type="radio" id="{{$option}}" name="status" value="{{$option}}" wire:model="status" wire:click="$set('order_id', {{$order->id}})">
                                                                <label for="{{$option}}">{{$option}}</label><br>
                                                            @endforeach --}}
                                                            @foreach($options as $option)
                                                                <input type="radio" id="{{$option . '_' . $order->id}}" name="status" value="{{$option}}" wire:model="status" wire:click="$set('order_id', {{$order->id}})">
                                                                <label for="{{$option . '_' . $order->id}}">{{$option}}</label><br>
                                                            @endforeach
                                                            @error('status')
                                                                <p class="text-danger">{{$message}} </p>
                                                            @enderror
                                                        </div>
                                                        <!-- Use wire:model for the $order_id property -->
                                                        <input type="hidden" wire:model="order_id">
                                                        <button type="submit" class="btn float-end">Update</button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{$orders->links()}} --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
