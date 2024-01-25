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
                            @if (Session::has('message'))
                                <div class="alert alert-warning" role="alert">{{Session::get('message')}} </div>
                            @endif
                            <form wire:submit.prevent="generatePDF">
                                @csrf
                                <div class="form-group col-md-3">
                                    <label for="inputTanggal">Start Date</label>
                                    <input type="date" class="form-control" wire:model="startdate">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputTanggal">End Date</label>
                                    <input type="date" class="form-control" wire:model="enddate">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputCategory">Category</label>
                                    <select wire:model="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="button">Generate Report</button>
                                {{-- <button wire:click="generatePDF">Generate PDF</button> --}}
                            </form>                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
