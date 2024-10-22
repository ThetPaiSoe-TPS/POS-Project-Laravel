@extends('admin.layouts.master')

@section('pageContent')
    <div class="container">
        <div class="row">
            <div class="card col-6 offset-3 shadow-sm mb-5">
                <div class="">
                    <h1 class="h3 pt-3 mt-3 text-center"><a href=""><span class="bg-primary p-3 text-white rounded-sm">Product Edit Page</span></a></h1>
                </div>
                <form action="{{route('product#update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="">
                            <div class="mt-2 d-flex justify-content-center">
                                <input type="hidden" name="oldImage" value="{{$product->image}}">
                                <input type="hidden" name="productId" value="{{$product->id}}">
                                <img src="{{asset('product/'.$product->image)}}" id="output" class="w-50 img-thumbnail" alt="">
                            </div>
                            <div class="my-4 ">
                                <input type="file" name="image" id="" class=" @error('image') is-invalid @enderror" onchange="loadFile(event)">
                                @error('image')
                                    <small class="text-danger invalid-feedback"> {{$message}} </small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Product Name</label>
                                    <input type="type" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $product->name)}}" placeholder="Enter Product Name...">
                                    @error('name')
                                        <small class="text-danger invalid-feedback"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Category Name</label>
                                    <select class="form-control @error('categoryName') is-invalid @enderror" aria-label="Default select example" name="categoryName" >
                                        <option value="{{null}}" > Choose Category Name... </option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" > {{$category->name}} </option>
                                        @endforeach
                                      </select>
                                    @error('categoryName')
                                        <small class="text-danger invalid-feedback"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Stock</label>
                                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{old('stock', $product->stock)}}" placeholder="Enter stock count...">
                                    @error('stock')
                                        <small class="text-danger invalid-feedback"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Price [MMK] </label>
                                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price', $product->price)}}" placeholder="Enter price...">                                    @error('price')
                                        <small class="text-danger invalid-feedback"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea name="description" id="" cols="30"  class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Write some description...">
                                {{old('description', $product->description)}}
                            </textarea>
                            @error('description')
                                <small class="text-danger invalid-feedback"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                        <div class=" text-center">
                            <a type="submit" href="{{route('product#list')}}" class="btn btn-dark text-white ">Back</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
