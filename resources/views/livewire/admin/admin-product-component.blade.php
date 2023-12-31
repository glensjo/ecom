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
                    <span></span> Manage Products
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
                                    Manage Products
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.product.add') }}" class="btn btn-success float-end">Add New Product</a>
                                </div>
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
                                        <th>Images</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = ($products->currentPage()-1)*$products->perPage();
                                    @endphp
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{++$i}} </td>
                                            <td><img src="{{ asset('assets/imgs/products') }}/{{$product->image}}" alt="{{$product->name}}" width="60"></td>
                                            <td>{{$product->name}} </td>
                                            <td>{{$product->regular_price}} </td>
                                            <td>{{$product->category->name}} </td>
                                            <td>
                                                <a href="{{ route('admin.product.edit', ['product_id'=>$product->id]) }}" class="text-info">Edit</a>
                                                {{-- <a href="{{ route('admin.product.edit',['product_id'=>$product->id]) }}" class="text-info">Edit</a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$products->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
