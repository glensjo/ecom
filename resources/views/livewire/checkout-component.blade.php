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
                @if ($carts->count() > 0)
                    <div class="row">
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
                                                    <span>Rp {{ number_format($item->product->regular_price * $item->qty, 3, '.', '.') }} </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th>SubTotal</th>
                                            <td class="product-subtotal" colspan="2">Rp {{ number_format($sub_total, 3, '.', '.') }} </td>
                                        </tr>
                                        <tr>
                                            <th>Tax (10%) </th>
                                            <td class="product-subtotal" colspan="2">Rp {{ number_format($tax, 3, '.', '.') }} </td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">Rp {{ number_format($total, 3, '.', '.') }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            <div class="payment_method">
                                <div class="mb-25">
                                    <h5>Payment</h5>
                                </div>
                                <form wire:submit.prevent="placeOrder">
                                    @csrf
                                    <div class="mb-3 mt-3">
                                        <label for="company" class="form-label">Company Name (optional)</label>
                                        <input type="text" name="company" class="form-control" placeholder="Your Company Name" wire:model="company">
                                        @error('company')
                                            <p class="text-danger">{{$message}} </p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="payment_image" class="form-label">Upload your payment</label>
                                        <input type="file" name="payment_image" class="form-control" wire:model="payment_image">
                                        @if ($payment_image)
                                            <img src="{{$payment_image->temporaryUrl()}}" width="120">
                                        @endif
                                        @error('payment_image')
                                            <p class="text-danger">{{$message}} </p>
                                        @enderror
                                    </div>
                                    <button type="submit" class="button button-add-to-cart float-end">Pay and Order</button>
                                </form>
                                *Please contact us if you need help.
                            </div>
                        </div>
                    </div>
                @else
                    No item to checkout. <a href="{{ route('shop') }}"><span>Please add item to cart...</span></a>
                @endif
            </div>
        </section>
    </main>
</div>
