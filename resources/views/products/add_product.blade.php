@extends('layouts.layout')

@section('title','Add Product Page')

@section('content')



<section>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Add Product</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 padding-top-20 ">
                    <form class="row" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-6 mb-3">
                            <label for="product name">Product Name</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Product Name" name="name" value="{{old('product_name')}}">
                            @error('product_name')
                            <p class="badge" style="color:red;">{{$message}}</p>
                            @enderror
                            @error('slug')
                            <p class="badge" style="color:red;">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group col-6 mb-3">
                            <label for="category">Category</label>

                            <select class="form-select" data-choices data-choices-search-false name="category">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name  }}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <p class="badge" style="color:red;">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="thumbnail">Thumbnail</label>
                            <input type="file" class="form-control" id="formGroupExampleInput2" placeholder="Category" name="thumbnail" value="{{old('thumbnail')}}" name="thumbnail">
                            @error('thumbnail')
                            <p class="badge" style="color:red;">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="Image">Image</label>
                            <input type="file" class="form-control" multiple id="formGroupExampleInput2" placeholder="Category" value="{{old('image')}}" name="image[]">
                            @error('image')
                            <p class="badge" style="color:red;">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="product description">Description</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Product Description" value="{{old('description')}}" name="description">
                            @error('description')
                            <p class="badge" style="color:red;">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="product prize">Prize</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Product Prize" value="{{old('prize')}}" name="prize">
                            @error('prize')
                            <p class="badge" style="color:red;">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="product quantity">Quantity</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Product Quantity" value="{{old('quantity')}}" name="quantity">
                            @error('quantity')
                            <p class="badge" style="color:red;">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="product Status">Status</label>
                            <select class="form-select" name="status">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('status')
                            <p class="badge" style="color:red;">{{$message}}</p>
                            @enderror
                        </div>


                        <br />
                        <div class="form-group">
                            <button class="btn btn-primary">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    @if(session('success'))
    alert("{{ session('success') }}");
    @endif
</script>

@endsection