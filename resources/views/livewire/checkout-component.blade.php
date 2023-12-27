<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span><a href="{{ route('shop') }}"> Shop</a>
                    <span></span> Checkout
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="divider mt-50 mb-50"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-25">
                            <h4>Billing Details</h4>
                        </div>
                        <form method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" required="" name="fname" placeholder="First name *">
                            </div>
                            <div class="form-group">
                                <input type="text" required="" name="lname" placeholder="Last name *">
                            </div>
                            <div class="form-group">
                                <input required="" type="text" name="cname" placeholder="Company Name">
                            </div>
                            <div class="form-group">
                                <input type="text" name="billing_address" required="" placeholder="Address *">
                            </div>
                            <div class="form-group">
                                <input required="" type="text" name="zipcode" placeholder="Postcode / ZIP *">
                            </div>
                            <div class="form-group">
                                <input required="" type="text" name="phone" placeholder="Phone *">
                            </div>
                            <div class="form-group">
                                <input required="" type="text" name="email" placeholder="Email address *">
                            </div>
                            <div class="mb-20">
                                <h5>Additional information</h5>
                            </div>
                            <div class="form-group mb-30">
                                <textarea rows="5" placeholder="Order notes"></textarea>
                            </div>
                        {{-- </form> --}}
                    </div>
                    <div class="col-md-6">
                        <div class="order_review">
                            <div class="mb-20">
                                <h4>Your Orders</h4>
                            </div>
                            <div class="table-responsive order_table text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $item)
                                            <tr>
                                                <td class="image product-thumbnail"><img src="{{ asset('assets/imgs/designs') }}/{{$item->design_image}}" alt="{{$item->product->name}}"></td>
                                                <td class="product-des product-name">
                                                    <h5 class="product-name"><a href="{{ route('product.details',['slug'=>$item->product->slug]) }}">{{$item->product->name}}</a></h5>
                                                    <span class="qty-val">x {{$item->qty}}</span>
                                                    @if ($item->product->category->name == "Convection")
                                                    , size : <span>{{$item->size}} </span>
                                                    @endif
                                                </td>
                                                <td class="text-right" data-title="Cart">
                                                    <span>Rp {{$item->product->regular_price * $item->qty}}.000 </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th>SubTotal</th>
                                            <td class="product-subtotal" colspan="2">Rp {{ $sub_total }} </td>
                                        </tr>
                                        <tr>
                                            <th>Tax</th>
                                            <td class="product-subtotal" colspan="2">Rp {{ $tax }} </td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">Rp {{ $total }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            <div class="payment_method">
                                <div class="mb-25">
                                    <h5>Payment</h5>
                                </div>
                                {{-- <form > --}}
                                    {{-- @csrf --}}
                                    <div class="mb-3 mt-3">
                                        <label for="payment_image" class="form-label">Upload your payment</label>
                                        <input type="file" name="payment_image" class="form-control" wire:model="payment_image">
                                        {{-- @if ($payment_image)
                                            <img src="{{$payment_image->temporaryUrl()}}" width="120">
                                        @endif
                                        @error('payment_image')
                                            <p class="text-danger">{{$message}} </p>
                                        @enderror --}}
                                    </div>
                                    <button type="submit" class="button button-add-to-cart float-end">Pay and Order</button>
                                </form>
                                *Please contact us if you need help.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
