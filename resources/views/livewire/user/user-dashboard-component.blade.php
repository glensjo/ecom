<div>
    <section class="mt-50 mb-50">
        <div class="container">
            <h2>Hi, {{ Auth::user()->name }}</h2><br>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table shopping-summery text-center clean">
                            @if ($orders)
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
                                        <td class="text-center" data-title="Stock">
                                            <div class="detail-qty border radius  m-auto">
                                                <a href="#" class="qty-down" wire:click.prevent="decreaseQuantity('{{$item->id}}')"><i class="fi-rs-angle-small-down"></i></a>
                                                <span class="qty-val">{{$item->qty}}</span>
                                                <a href="#" class="qty-up" wire:click.prevent="increaseQuantity('{{$item->id}}')"><i class="fi-rs-angle-small-up"></i></a>
                                            </div>
                                        </td>
                                        <td class="text-right" data-title="Cart">
                                            <span>Rp {{$item->product->regular_price * $item->qty}}.000 </span>
                                        </td>
                                        <td>...</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @else
                                <p>Waiting for your Orders...</p>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
