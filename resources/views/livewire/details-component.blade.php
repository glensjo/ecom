<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Fashion
                    <span></span> Abstract Print Patchwork Dress
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-gallery">
                                        <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                        <div class="product-image-slider">
                                            <figure class="border-radius-10">
                                                <img src="{{ asset('assets/imgs/products') }}/{{$product->image}}" alt="product image">
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info">
                                        <h2 class="title-detail">{{$product->name}}</h2>
                                        <div class="product-detail-rating">
                                            <div class="pro-details-brand">
                                                <span> Brands: <a href="{{ route('product.category',['slug'=>$product->category->slug]) }}">{{$product->category->name}}</a></span>
                                            </div>
                                        </div>
                                        <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">
                                                <ins><span class="text-brand">Rp {{$product->regular_price}}</span></ins>                                                
                                            </div>
                                        </div>
                                        <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                        <div class="short-desc mb-30">
                                            <p>{{$product->short_description}}</p>
                                        </div>
                                        <div class="product_sort_info font-xs mb-30">
                                            <ul>
                                                <li class="mb-10"><i class="fi-rs-refresh mr-5"></i> 7 Day Return Policy</li>
                                                <li><i class="fi-rs-credit-card mr-5"></i> Cash Before Delivery</li>
                                            </ul>
                                        </div>
                                        {{-- <div class="attr-detail attr-color mb-15">
                                            <strong class="mr-10">Color</strong>
                                            <ul class="list-filter color-filter">
                                                <li><a href="#" data-color="Red"><span class="product-color-red"></span></a></li>
                                                <li><a href="#" data-color="Yellow"><span class="product-color-yellow"></span></a></li>
                                                <li class="active"><a href="#" data-color="White"><span class="product-color-white"></span></a></li>
                                                <li><a href="#" data-color="Orange"><span class="product-color-orange"></span></a></li>
                                                <li><a href="#" data-color="Cyan"><span class="product-color-cyan"></span></a></li>
                                                <li><a href="#" data-color="Green"><span class="product-color-green"></span></a></li>
                                                <li><a href="#" data-color="Purple"><span class="product-color-purple"></span></a></li>
                                            </ul>
                                        </div> --}}
                                        <form wire:submit.prevent="addCart">
                                            
                                            @if ($product->category->name == "Convection")
                                                {{-- <div class="attr-detail attr-size">
                                                    <strong class="mr-10">Size</strong>
                                                    <div class="size-buttons">
                                                        <button class="size-button" onclick="selectSize(this)">S</button>
                                                        <button class="size-button" onclick="selectSize(this)">M</button>
                                                        <button class="size-button" onclick="selectSize(this)">L</button>
                                                        <button class="size-button" onclick="selectSize(this)">XL</button>
                                                    </div>                                                
                                                </div> --}}
                                                <div class="mb-3 mt-3">
                                                    <label for="size" class="form-label">Size</label>
                                                    <input type="text" name="size" class="form-control" placeholder="Enter Your Custom Size" wire:model="size">
                                                    @error('size')
                                                        <p class="text-danger">{{$message}} </p>
                                                    @enderror
                                                </div>
                                            @endif
                                            <div class="mb-3 mt-3">
                                                <label for="qty" class="form-label">Quantity</label>
                                                <input type="number" name="qty" class="form-control" placeholder="Enter Your Custom Quantity" wire:model="qty">
                                                @error('qty')
                                                    <p class="text-danger">{{$message}} </p>
                                                @enderror
                                            </div>                          
                                            <div class="mb-3 mt-3">
                                                <label for="custom_description" class="form-label">Custom Description</label>
                                                <textarea name="custom_description" class="form-control" placeholder="Enter Your Custom Description" wire:model="custom_description"></textarea>
                                                @error('custom_description')
                                                    <p class="text-danger">{{$message}} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 mt-3">
                                                <label for="design_image" class="form-label">Design Image</label>
                                                <input type="file" name="design_image" class="form-control" wire:model="design_image">
                                                @if ($design_image)
                                                    <img src="{{$design_image->temporaryUrl()}}" width="120">
                                                @endif
                                                @error('design_image')
                                                    <p class="text-danger">{{$message}} </p>
                                                @enderror
                                            </div>
                                            @auth                                        
                                                <button type="submit" class="button button-add-to-cart float-end">Add to cart</button>                                                    
                                            @else
                                                <button type="button" class="button button-add-to-cart float-end" onclick="location.href='/login'">Add to cart</button>
                                            @endauth
                                        </form>
                                    </div>
                                    <!-- Detail Info -->
                                </div>
                            </div>
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                                    </li>
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        <div class="">
                                            {{$product->description}}
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Additional-info">
                                        <table class="font-md">
                                            <tbody>
                                                <tr class="stand-up">
                                                    <th>Stand Up</th>
                                                    <td>
                                                        <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                                    </td>
                                                </tr>
                                                <tr class="folded-wo-wheels">
                                                    <th>Folded (w/o wheels)</th>
                                                    <td>
                                                        <p>32.5″L x 18.5″W x 16.5″H</p>
                                                    </td>
                                                </tr>
                                                <tr class="folded-w-wheels">
                                                    <th>Folded (w/ wheels)</th>
                                                    <td>
                                                        <p>32.5″L x 24″W x 18.5″H</p>
                                                    </td>
                                                </tr>
                                                <tr class="door-pass-through">
                                                    <th>Door Pass Through</th>
                                                    <td>
                                                        <p>24</p>
                                                    </td>
                                                </tr>
                                                <tr class="frame">
                                                    <th>Frame</th>
                                                    <td>
                                                        <p>Aluminum</p>
                                                    </td>
                                                </tr>
                                                <tr class="weight-wo-wheels">
                                                    <th>Weight (w/o wheels)</th>
                                                    <td>
                                                        <p>20 LBS</p>
                                                    </td>
                                                </tr>
                                                <tr class="weight-capacity">
                                                    <th>Weight Capacity</th>
                                                    <td>
                                                        <p>60 LBS</p>
                                                    </td>
                                                </tr>
                                                <tr class="width">
                                                    <th>Width</th>
                                                    <td>
                                                        <p>24″</p>
                                                    </td>
                                                </tr>
                                                <tr class="handle-height-ground-to-handle">
                                                    <th>Handle height (ground to handle)</th>
                                                    <td>
                                                        <p>37-45″</p>
                                                    </td>
                                                </tr>
                                                <tr class="wheels">
                                                    <th>Wheels</th>
                                                    <td>
                                                        <p>12″ air / wide track slick tread</p>
                                                    </td>
                                                </tr>
                                                <tr class="seat-back-height">
                                                    <th>Seat back height</th>
                                                    <td>
                                                        <p>21.5″</p>
                                                    </td>
                                                </tr>
                                                <tr class="head-room-inside-canopy">
                                                    <th>Head room (inside canopy)</th>
                                                    <td>
                                                        <p>25″</p>
                                                    </td>
                                                </tr>
                                                <tr class="pa_color">
                                                    <th>Color</th>
                                                    <td>
                                                        <p>Black, Blue, Red, White</p>
                                                    </td>
                                                </tr>
                                                <tr class="pa_size">
                                                    <th>Size</th>
                                                    <td>
                                                        <p>M, S</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                          
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">Category</h5>
                            <ul class="categories">
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('product.category',['slug'=>$category->slug]) }}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Product sidebar Widget -->
                        <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Related products</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            @foreach ($rproducts as $rproduct)
                                <div class="single-post clearfix">
                                    <div class="image">
                                        <a href="{{ route('product.details',['slug'=>$rproduct->slug]) }}">
                                            <img src="{{ asset('assets/imgs/products') }}/{{$rproduct->image}}" alt="{{$rproduct->name}}">
                                        </a>
                                    </div>
                                    <div class="content pt-10">
                                        <h5><a href="{{ route('product.details',['slug'=>$rproduct->slug]) }}">{{$rproduct->name}}</a></h5>
                                        <p class="price mb-0 mt-5">Rp {{$rproduct->regular_price}}</p>
                                    </div>
                                </div>
                            @endforeach                            
                        </div>                        
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

@push('scripts')
<script>
    function setSize(size) {
        Livewire.emit('setSize', size);
    }
</script>
<!-- Add this at the end of your HTML or layout file -->
<script>
    Livewire.on('setSize', size => {
        Livewire.component('product-details').setSize(size);
    });
</script>

<!-- Add this script after your existing script -->
<script>
    let selectedSize = null;

    function selectSize(button) {
        // If the button is already selected, deselect it
        if (button.classList.contains('selected')) {
            button.classList.remove('selected');
            selectedSize = null;
        } else {
            // Deselect all size buttons
            const sizeButtons = document.querySelectorAll('.size-button');
            sizeButtons.forEach(btn => btn.classList.remove('selected'));

            // Select the clicked button
            button.classList.add('selected');
            selectedSize = button.innerText;
        }

        // Disable all size buttons except the selected one
        const sizeButtons = document.querySelectorAll('.size-button');
        sizeButtons.forEach(btn => {
            if (btn.innerText !== selectedSize) {
                btn.disabled = false; // Enable all size buttons
            }
        });
    }
</script>



@endpush

