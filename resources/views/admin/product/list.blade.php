@extends('admin.layouts.master')

@section('pageContent')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center mb-4 mt-5">
            <h1 class="h3 mb-0 "><a href="{{route('product#list')}}"><span class="bg-primary p-3 text-white rounded-sm">Product List</span></a></h1>
        </div>
        {{-- input form --}}
        <div class="">
            <div class="row">
                <div class="col-10 offset-1 ">
                    <div class=" py-3 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="border-dark border rounded p-2 mr-2">
                                <i class="fa-solid fa-database mr-2"></i> <span >Product Count</span> <span class="badge badge-pill bg-danger text-white ml-2"> {{count($products)}} </span>
                            </span>
                                <a class="btn btn-outline-danger mr-1" href="{{route('product#list', 'amt')}}"><i class="fa-regular fa-circle-down mr-2"></i>Low Stock List</a>
                                <a href="{{route('product#create')}}" class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square mr-2"></i></i>Add New Product</a>
                        </div>
                        <div class="">
                            <form action="{{route('product#list')}}" method="get" >
                                @csrf
                                <div class="d-flex align-items-center">
                                    <input type="text" name="search" value="{{request('search')}}" placeholder="search..." id="" class="form-control">
                                    <button class="btn btn-primary"><i class="fa fa-magnifying-glass bg-primary text-white "></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table-hover table table-bordered">
                        <thead class="">
                            <tr class="bg-primary text-white text-center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Description</th>
                                <th>Category Name</th>
                                <th >Function</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="text-center text-primary">
                                    <td> {{$product->id}} </td>
                                    <td> {{$product->name}} </td>
                                    <td class="col-2"> <img src="{{asset('product/'.$product->image)}}" class="img-fluid w-50" alt=""> </td>
                                    <td> {{$product->price}} MMK </td>
                                    @if ($product->stock <=5)
                                    <td class="text-danger"> <b>{{$product->stock}}</b> </td>
                                    @else
                                    <td class="text-success"> <b>{{$product->stock}}</b> </td>
                                    @endif
                                    <td> {{$product->description}} </td>
                                    <td> {{$product->category_name}} </td>
                                    <td class="function-icon">
                                        <a href="{{route('product#listPage', $product->id)}}"><button class="btn"><i class="fa-solid fa-eye text-primary"></i></i></button></a>
                                        <a href="{{route('product#updatePage', $product->id)}}"><button class="btn"><i class="fa-solid fa-pen-to-square text-dark"></i></button></a>
                                        <a href="{{route('product#delete', $product->id)}}"><button class="btn"><i class="fa-solid fa-trash text-danger"></i></button></a>
                                </tr>
                            @endforeach
                        </tbody>

                </table>
                <div class="d-flex justify-content-end"> {{$products->links()}} </div>
                </div>
            </div>

        </div>

    </div> <!--- extra -->


@endsection

