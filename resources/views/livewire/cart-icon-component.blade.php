<div class="header-action-icon-2">
    @auth  
        <a class="mini-cart-icon" href="{{ route('shop.cart') }}">
            <img alt="Cart" src="{{ asset('assets/imgs/theme/icons/icon-cart.svg') }}">
            @if ($carts!==1)
                <span class="pro-count blue">{{ $total }}</span>
            @endif
        </a>                                 
        <div class="cart-dropdown-wrap cart-dropdown-hm2">
            <ul>
                @foreach ($carts as $item)
                    <li>
                        <div class="shopping-cart-img">
                            <a href="{{ route('product.details',['slug'=>$item->product->slug]) }}"><img alt="{{$item->product->name}}" src="{{ asset('assets/imgs/products') }}/{{$item->product->image}}"></a>
                        </div>
                        <div class="shopping-cart-title">
                            <h4><a href="{{ route('product.details',['slug'=>$item->product->slug]) }}">{{ substr($item->product->name,0,20) }}...</a></h4>
                            <h4><span>{{$item->qty}} × </span>${{$item->product->regular_price}}</h4>
                        </div>
                    </li>
                @endforeach            
            </ul>
            <div class="shopping-cart-footer">
                <div class="shopping-cart-total">
                    <h4>Total <span>${{Cart::total()}}</span></h4>
                </div>
                <div class="shopping-cart-button">
                    <a href="{{ route('shop.cart') }}" class="outline">View cart</a>
                    <a href="{{ route('shop.checkout') }}">Checkout</a>
                </div>
            </div>
        </div>
    @else
        <a class="mini-cart-icon" href="{{ route('login') }}">
            <img alt="Cart" src="{{ asset('assets/imgs/theme/icons/icon-cart.svg') }}">
            @if ($carts!==1)
                <span class="pro-count blue">{{ $total }}</span>
            @endif
        </a>  
    @endauth
    
</div>