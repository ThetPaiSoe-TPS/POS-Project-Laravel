@extends('admin.layouts.master')

@section('pageContent')
    <div class="container" style="padding-bottom: 300px">
        <a href="{{route('order#list')}}" class="btn btn-primary"><i class="fa-solid fa-rotate-left mr-2"></i>Back</a>
        <h1 class="text-center my-3">User Order Detailed List</h1>
        <div class="row offset-2">

            <div class="col-5 ">
                <div class="card shadow">
                    <div class="card-body d-flex justify-content-between ">
                       <div class="d-flex flex-column col-6">
                            <b>Name: </b>
                            <b>Phone: </b>
                            <b>{{ $order_codes[0]['phone']!== $payment['phone']? 'New Phone: ' : '' }}</b>
                            <b>Address: </b>
                            <b>{{ $order_codes[0]['address']!== $payment['address']? 'New Address: ' : '' }}</b>
                            <b>Order Code: </b>
                            <b>Order Date: </b>
                            <b>Total Price: </b>
                       </div>
                       <div class="d-flex flex-column ">
                            <span> {{$order_codes[0]['user_name']}} </span>
                            {{-- <span> {{$order_codes[0]['phone']== ? $order_codes[0]['phone']: }}  </span> --}}
                            <span>
                                @if($order_codes[0]['phone']== $payment['phone'])
                                    {{$order_codes[0]['phone']}}
                                @else
                                    {{$order_codes[0]['phone']}}
                                    {{$payment['phone']}}
                                @endif

                            </span>
                            <span> {{$order_codes[0]['address']}} </span>
                            <span>
                                @if($order_codes[0]['address']== $payment['address'])
                                    {{$order_codes[0]['address']}}
                                @else
                                    {{$payment['address']}}
                                @endif
                            </span>
                            <span id="orderCode"> {{$order_codes[0]['order_code']}} </span>
                            <span> {{$order_codes[0]['created_at']->format('j/M/Y')}} </span>
                            <span> {{$order_codes[0]['price']}} MMk </span>
                            <small class="text-danger">(contained delivery charges)</small>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-5 ">
                <div class="card shadow">
                    <div class="card-body d-flex justify-content-between ">
                       <div class="d-flex flex-column ">
                            <b>Email : </b>
                            <b>Payment Method: </b>
                       </div>
                       <div class="d-flex flex-column mr-2">
                            <span > {{$order_codes[0]['email']}} </span>
                            <span> {{$payment['payment_method']}} </span>
                       </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <img src="{{asset('paymentSlip/'.$payment['payslip_image'])}}" class=" " width="150px"  alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-10 mx-auto ">
                <div class="card shadow">
                    <div class="card-heading">
                        <h3 class="text-center mt-3">Order Board</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white text-center">
                                <tr>
                                    <th style="width: 120px">Image</th>
                                    <th>Name</th>
                                    <th>Count</th>
                                    <th>Available Stock</th>
                                    <th>Product Price</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($order_codes as $item)
                                    <tr>
                                        <input type="hidden" name="productId" class="productId" value="{{$item->product_id}}">
                                        <input type="hidden" name="productCount" class="productCount" value="{{$item->count}}">
                                        <td> <img src="{{asset('product/'.$item['image'])}}" class="img-fluid img-thumbnail" alt=""> </td>
                                        <td> {{$item['product_name']}} </td>
                                        <td> {{$item['count']}} <span class="badge p-2 ml-2 {{$item['count']> $item['stock']? 'text-white bg-danger': 'bg-success text-white' }} "> <i class=" {{$item['count']> $item['stock']? 'fa-solid fa-triangle-exclamation': 'fa-regular fa-circle-check' }}  "></i> {{$item['count']> $item['stock']? 'Out of Stock': 'Available Stock' }}  </span> </td>
                                        <td class="{{$item['stock']<=5? 'text-danger': 'text-success'}}" > <b>{{$item['stock']}}</b> </td>
                                        <td> {{$item['price']}} MMK </td>
                                        <td> {{$item['price']* $item['count'] }} MMK </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <form action="{{route('order#confirmOrder')}}" method="get">
                    <div class="d-flex justify-content-end">
                        <input type="button" class="btn btn-success mt-3 mr-3" @if(!$status) disabled @endif value="Confirm Order" id="orderConfirm">
                        <input type="button" class="btn btn-danger mt-3 mr-3" value="Cancel Order" id="orderCancel">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('jQueryScript')
<script>
    $(document).ready(function(){
        $('#orderConfirm').click(function(){

            $data= [];
            $orderCode= $('#orderCode').text();

            $('.table tbody tr').each(function(index, row){
                $productId= $(row).find('.productId').val();
                $productCount= $(row).find('.productCount').val();

                $data.push({
                    'product_id': $productId,
                    'product_count': $productCount,
                    'order_code': $orderCode
                })
            })

            //send with ajax
            $.ajax({
                type: 'get',
                url: '/admin/profile/order/confirmOrder',
                data: Object.assign({}, $data),
                dataType: 'json',
                success: function(res){
                    res.status== 'succeeded'? location.href= '/admin/profile/order/list': '';
                }
            })
        });

        //cancle order
        $('#orderCancel').click(function(){
            $orderCode= $('#orderCode').text();
            $data= { 'orderCode': $orderCode }

            //send with ajax
            $.ajax({
                type: 'get',
                url: '/admin/profile/order/cancelOrder',
                dataType: 'json',
                data: $data,
                success: function(res){
                    res.status== 'succeeded'? location.href= '/admin/profile/order/list': '';
                }
            })

        })
    })
</script>
@endsection
