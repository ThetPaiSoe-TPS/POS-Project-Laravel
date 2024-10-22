@extends('admin.layouts.master')

@section('pageContent')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="">
                    <h3 class="h3 my-3 text-center"><a href=""><span class="bg-primary p-3 text-white rounded-sm">Product List</span></a></h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-3">
                        <img src="{{asset('product/'.$product->image)}}"  class="img-profile img-thumbnail w-75" alt="">
                    </div>
                    <div class="col-5 ">
                        <div class="row">
                            <div class="d-flex flex-column col-auto text-primary">
                                <b class="">Product Id:</b>
                                <b>Product Name:</b>
                                <b>Price:</b>
                                <b>Description:</b>
                                <b>Stock:</b>
                            </div>
                            <div class="d-flex flex-column col-auto">
                                <span class=""> {{$product->id}} </span>
                                <span> {{$product->name}} </span>
                                <span> {{$product->price}} MMK </span>
                                <span> {{$product->description}}</span>
                                <span> {{$product->stock}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <div>
                <a href=" {{route('product#updatePage', $product->id)}} " class="btn btn-primary"><i class="fa-regular fa-pen-to-square mx-1"></i>Edit Product</a>
                <a href="{{route('product#list')}}" class="btn btn-dark text-white"><i class="fa-solid fa-arrow-left mx-1"></i>Back</a>
            </div>
    </div>
@endsection


