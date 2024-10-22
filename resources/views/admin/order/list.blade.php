@extends('admin.layouts.master')

@section('pageContent')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-primary"><a href="{{route('order#list')}}">Order List</a></h1>
        </div>

        {{-- input form --}}
        <div class="">
            <div class="row">
                <div class="col-10 offset-1">
                    <div class="w-100 d-flex justify-content-end">
                        <form action="{{route('order#list')}}" method="get" class="w-25">
                            @csrf
                            <div class="mb-3 d-flex align-items-center">
                                <input type="text" name="search" value="{{request('search')}}" placeholder="search..." id="" class="form-control">
                                <button class="btn btn-primary"><i class="fa fa-magnifying-glass bg-primary text-white "></i></button>
                            </div>
                        </form>
                    </div>
                    <table class="table-hover table table-bordered">
                        <thead>
                            <tr class="bg-primary text-white text-center">
                                <th>Name</th>
                                <th>Order Code</th>
                                <th>Ordered Date</th>
                                <th>Action</th>
                                <th>State</th>
                            </tr>
                        </thead>
                    @foreach ($orders as $order )
                        <tbody>
                            <tr>
                                <input type="hidden" name="" class="order_code" value="{{$order->order_code}}">
                                <td> {{ $order->user_name }} </td>
                                <td> <a href="{{route('order#details', $order->order_code)}}" >{{ $order->order_code }}</a> </td>
                                <td> {{ $order->created_at->format('j/M/Y') }} </td>
                                <td class="text-center">
                                    <select name="" id="" class="form-control w-75 action">
                                        <option value="0" class="" @if($order->status==0) selected @endif>Pending</option>
                                        <option value="1" class="" @if($order->status==1) selected @endif>Succeeded</option>
                                        <option value="2" class=""@if($order->status==2) selected @endif>Rejected</option>
                                    </select>
                                    {{-- @if($order->status== 0) <span></span>
                                    @elseif($order->status== 1) <span></span>
                                    @else <span></span>
                                    @endif --}}
                                </td>
                                <td class="text-center">
                                    @if($order->status==0) <span class="badge bg-warning p-2 text-dark"><i class="fa-solid fa-person-biking mr-2"></i>Pending</span> @endif
                                    @if($order->status==1) <span class="badge bg-success p-2 text-dark"><i class="fa-regular fa-circle-check mr-2"></i>Succeeded</span> @endif
                                    @if($order->status==2) <span class="badge bg-danger text-white p-2"><i class="fa-solid fa-ban mr-2"></i>Rejected</span> @endif
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
                {{-- <div class="d-flex justify-content-end"> {{ $orders->links() }} </div> --}}
                </div>
            </div>

        </div>

    </div> <!--- extra -->


@endsection

@section('jQueryScript')
    <script>
        $(document).ready(function(){
            $('.action').change(function(){
                $action= $(this).val();
                $order_code= $(this).parents('tr').find('.order_code').val();

                $data= {
                    'order_code': $order_code,
                    'status': $action
                }

                //send with ajax
                $.ajax({
                    type: 'get',
                    url: '/admin/profile/order/changeStatus',
                    data: $data,
                    dataType: 'json',
                    success: function(res){
                        res.status== 'succeeded'? location.reload(): '';
                    }
                })
            });





        })
    </script>
@endsection

