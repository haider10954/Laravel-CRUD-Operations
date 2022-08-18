@extends('layouts.layout')

@section('title','Edit Customer Page')

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
                                    <li class="breadcrumb-item active">Edit Customers</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 padding-top-20 ">
                    <form class="row" action="{{ route('customer.update',$customers->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method ('PUT')
                        <div class="form-group col-6 mb-3">
                            <label for="product name">Name</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Customer Name" value="{{old('name',$customers->name)}}" name="name">
                            @error('name')
                            <p class="badge" style="color:red;">{{$message}}</p>
                            @enderror
                            @error('slug')
                            <p class="badge" style="color:red;">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="thumbnail">Email</label>
                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Customer Email"  value="{{old('email',$customers->email)}}" name="email">
                            @error('email')
                            <p class="badge" style="color:red;">{{$message}}</p>
                            @enderror
                        </div>

                        <br />
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update Customer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection