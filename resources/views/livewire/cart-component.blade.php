<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span><a href="{{ route('shop') }}"> Shop</a>
                    <span></span> Your Cart
                </div>
            </div>
        </div>
        @auth                                        
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table shopping-summery text-center clean">
                                @if (Session::has('success_message'))
                                    <div class="alert alert-success">
                                        <strong>Success | {{Session::get('success_message')}} </strong>
                                    </div>                                      
                                @endif
                                @if (Session::has('info'))
                                    <div class="alert alert-info">
                                        <strong>Info | {{Session::get('info')}} </strong>
                                    </div>                                      
                                @endif
                                @if ($carts!==0)
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Size</th>                                        
                                        <th scope="col">Design</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $item)
                                        <tr>
                                            <td class="image product-thumbnail"><img src="{{ asset('assets/imgs/products') }}/{{$item->product->image}}" alt="{{$item->product->name}}"></td>
                                            <td class="product-des product-name">
                                                <h5 class="product-name"><a href="{{ route('product.details',['slug'=>$item->product->slug]) }}">{{$item->product->name}}</a></h5>
                                                </td>
                                            <td class="price" data-title="Price"><span>Rp {{$item->product->regular_price}} </span></td>
                                            <td class="price" data-title="Price"><span>{{$item->size}} </span></td>
                                            <td class="image product-thumbnail"><img src="{{ asset('assets/imgs/designs') }}/{{$item->design_image}}" alt="{{$item->product->name}}"></td>
                                            <td class="text-center" data-title="Stock">
                                                <div class="detail-qty border radius  m-auto">
                                                    <a href="#" class="qty-down" wire:click.prevent="decreaseQuantity('{{$item->id}}')"><i class="fi-rs-angle-small-down"></i></a>
                                                    <span class="qty-val">{{$item->qty}}</span>
                                                    <a href="#" class="qty-up" wire:click.prevent="increaseQuantity('{{$item->id}}')"><i class="fi-rs-angle-small-up"></i></a>
                                                </div>
                                            </td>
                                            <td class="text-right" data-title="Cart">
                                                <span>Rp {{ number_format($item->product->regular_price * $item->qty, 3, '.', '.') }}</span>
                                            </td>
                                            <td class="action" data-title="Remove"><a href="#" class="text-muted" wire:click.prevent="destroy('{{$item->id}}')"><i class="fi-rs-trash"></i></a></td>
                                        </tr>
                                    @endforeach
                                    
                                    <tr>
                                        <td colspan="8" class="text-end">
                                            <a href="#" class="text-muted" wire:click.prevent="clearAll()"> <i class="fi-rs-cross-small"></i> Clear Cart</a>
                                        </td>
                                    </tr>
                                </tbody>
                                @else
                                    <p>No item in cart</p>
                                @endif
                            </table>
                        </div>
                        <div class="cart-action text-end">
                            <a class="btn  mr-10 mb-sm-15" {{ route('shop.cart') }}><i class="fi-rs-shuffle mr-10"></i>Update Cart</a>
                            <a class="btn " href="{{ route('shop') }}"><i class="fi-rs-shopping-bag mr-10"></i>Continue Shopping</a>
                        </div>
                        <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                        <div class="row mb-50">
                            <div class="col-lg-6 col-md-12"></div>
                            <div class="col-lg-6 col-md-12">
                                <div class="border p-md-4 p-30 border-radius cart-totals">
                                    <div class="heading_s1 mb-3">
                                        <h4>Cart Totals</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Cart Subtotal</td>
                                                    <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">Rp {{ number_format($sub_total, 3, '.', '.') }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Tax (10%)</td>
                                                    <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">Rp {{ number_format($tax, 3, '.', '.') }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Total</td>
                                                    <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">Rp {{ number_format($total, 3, '.', '.') }}</span></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="{{ route('shop.checkout') }}" class="btn "> <i class="fi-rs-box-alt mr-10"></i> Proceed To CheckOut</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @else
            <div class="container">
                <div class="toggle_info">
                    <span><i class="fi-rs-user mr-10"></i><span class="text-muted">Please login to see your cart. </span> <a href="{{ route('login') }}">Click here to login</a></span>
                </div>
            </div>
        @endauth        
    </main>
</div>
