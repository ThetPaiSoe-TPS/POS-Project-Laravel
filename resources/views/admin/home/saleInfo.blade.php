@extends('admin.layouts.master')

@section('pageContent')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="h3 mb-0 text-primary"><a href="">Sale Infomation</a></h1>
    </div>

    {{-- input form --}}
    <div class="">
        <div class="row">
            <div class="col-10 offset-1">
                {{-- <div class="w-100 d-flex justify-content-end">
                    <form action={{route('product#saleInfo')}} method="get" class="w-25">
                        @csrf
                        <div class="mb-3 d-flex align-items-center">
                            <input type="text" name="search" value="{{request('search')}}" placeholder="search..." id="" class="form-control">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-magnifying-glass bg-primary text-white "></i></button>
                        </div>
                    </form>
                </div> --}}
                <table class="table-hover table table-bordered">
                    <thead>
                        <tr class="bg-primary text-white text-center">
                            <th>Name</th>
                            <th class="w-25">Image</th>
                            <th>Order Code</th>
                            <th>Price</th>
                            <th>Ordered Date</th>
                            <th>Status</th>
                            <th>Available Stock</th>
                        </tr>
                    </thead>
                @foreach ($orderList as $item )
                    <tbody>
                        <tr>
                            <td> {{ $item->user_name }} </td>
                            <td class="text-center"> <img class="w-50" src={{asset('product/'.$item->image)}} alt=""> </td>
                            <td> <a href="{{route('order#details', $item->order_code)}}">{{ $item->order_code }}</a> </td>
                            <td> {{ $item->price }} </td>
                            <td> {{ $item->created_at }} </td>
                            <td class="text-center">
                                @if($item->status==0) <span class="badge bg-warning p-2 text-dark"><i class="fa-solid fa-person-biking mr-2"></i>Pending</span> @endif
                                @if($item->status==1) <span class="badge bg-success p-2 text-dark"><i class="fa-regular fa-circle-check mr-2"></i>Succeeded</span> @endif
                                @if($item->status==2) <span class="badge bg-danger text-white p-2"><i class="fa-solid fa-ban mr-2"></i>Rejected</span> @endif
                            </td>
                            <td class="text-center"> {{ $item->stock }} </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
            <div class="d-flex justify-content-end"> {{ $orderList->links() }} </div>
            </div>
        </div>

    </div>

</div> <!--- extra -->
@endsection
