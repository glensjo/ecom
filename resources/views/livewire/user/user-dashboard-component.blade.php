<div>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow">Home</a>
                <span></span> Dashboard
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <h2>Hi, {{ Auth::user()->name }}</h2><br>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table shopping-summery text-center clean">
                            @if ($orders->count() > 0)
                            <div class="mb-20">
                                <h4>Your Orders</h4>
                            </div>
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Size</th>                                        
                                    <th scope="col">Design</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)
                                    <tr>
                                        <td class="image product-thumbnail"><img src="{{ asset('assets/imgs/products') }}/{{$item->product->image}}" alt="{{$item->product->name}}"></td>
                                        <td class="product-des product-name">
                                            <h5 class="product-name"><a href="{{ route('product.details',['slug'=>$item->product->slug]) }}">{{$item->product->name}}</a></h5>
                                            </td>
                                        <td class="price" data-title="Price"><span>Rp {{$item->product->regular_price}} </span></td>
                                        <td class="price" data-title="Price"><span>{{$item->size}} </span></td>
                                        <td class="image product-thumbnail"><img src="{{ asset('assets/imgs/designs') }}/{{$item->design_image}}" alt="{{$item->product->name}}"></td>
                                        <td class="text-center" data-title="Stock"><span class="qty-val">{{$item->qty}}</span></td>
                                        <td class="text-right" data-title="Cart">
                                            <span>Rp {{ number_format($item->product->regular_price * $item->qty, 3, '.', '.') }} </span>
                                        </td>
                                        <td><span>{{$item->status}} </span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @else
                                <a href="{{ route('shop') }}"><span> Waiting for your Orders... </span></a>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
