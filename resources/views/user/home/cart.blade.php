@extends('user.layouts.master')

@section('content')
 <!-- Cart Page Start -->
 <div class="container-fluid py-5 mt-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                  <tr>
                    <th scope="col">Products</th>
                    <th scope="col">Name</th>
                    <th scope="col" >Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                    <input type="hidden" class="userId" value="{{Auth::user()->id}}">
                    @foreach ($cartList as $cart)
                    <tr>
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                <img src={{asset('product/'.$cart->image)}} class="img-fluid me-5 img-thumbnail" style="width: 80px; height: 80px;" alt="">
                            </div>
                        </th>
                        <td>
                            <p class="mb-0 mt-4"> {{$cart->name}} </p>
                        </td>
                        <td >
                            <p class="mb-0 mt-4 price" >{{$cart->price}} MMK</p>
                        </td>
                        <td>
                            <div class="input-group quantity mt-4" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" id="qty" class="form-control form-control-sm text-center border-0 qty" value={{$cart->qty}}>
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 mt-4 total" id="total-price"> {{$cart->price* $cart->qty}} MMK </p>
                        </td>
                        <td>
                            <input type="hidden" class="productId" value="{{$cart->id}}">

                            <button class="btn btn-md rounded-circle bg-light border mt-4 btn-remove" >
                                <i class="fa fa-times text-danger"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="mt-5">
            <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
        </div>
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4 text-center">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal:</h5>
                            <p class="mb-0 sub-total"> {{$total}} MMK </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Delivering</h5>
                            <div class="">
                                <p class="mb-0">rate: <b>2500</b> MMK</p>
                            </div>
                        </div>
                        <p class="mb-0 text-end">Deliver to <b>{{ Auth::user()->address }}</b> </p>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        <p class="mb-0 pe-4 total-amount"> {{$total+ 2500}} MMK </p>
                    </div>
                    <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" @if(count($cartList) == 0) disabled @endif  id="btn-checkout" type="button">Proceed Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->


<!-- Back to Top -->
<a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

@endsection

@section('js-section')
    <script>
        $(document).ready(function(){
            //minus button
            $('.btn-minus').click(function(){
                $price= $(this).parents('tr').find('.price').text().replace('MMK', '');
                $qty= $(this).parents('tr').find('.qty').val();
                $total1= $price* $qty;
                $(this).parents('tr').find('.total').text($total1+ " MMK");
                total();
            })

            //plus button
            $('.btn-plus').click(function(){
                $price= $(this).parents('tr').find('.price').text().replace('MMK', '');
                $qty= $(this).parents('tr').find('.qty').val();
                $total= $price* $qty;
                $(this).parents('tr').find('.total').text($total+ " MMK");
                total();
            })

            //total function
            function total(){
                $total= 0;
                $('#table tbody tr td #total-price').each(function(item, row){
                    $total+= Number($(row).text().replace('MMK', ''));
                });
                $('.sub-total').text($total+ " MMK");
                $('.total-amount').text($total+ 2500+ " MMK");
            }

            //remove btn click
            $('.btn-remove').click(function(){
                $productId= $(this).parents('tr').find('.productId').val();

                $data= {
                    'cartId': $productId
                };

                $.ajax({
                    type: 'get',
                    url: '/user/product/delete',
                    data: $data,
                    dataType: 'json',
                    success: function(response){
                        response.status== 'success'? location.reload(): '';
                    }
                })
            })

            //check out

            $totalAmount= Number($('.total-amount').text().replace('MMK', ''));
            $('#btn-checkout').click(function(){
                $userId= $('.userId').val();
                $order_code= 'POS-Code-'+Math.floor(Math.random() * 100000);
                $data= [];

                $('#table tbody tr').each(function (index, row){
                   $productId= $(row).find('.productId').val();
                   $qty= $(row).find('.qty').val();

                   $data.push({
                        'user_id': $userId,
                        'product_id': $productId,
                        'qty': $qty,
                        'order_code': $order_code,
                        'total_amount': $totalAmount
                    })
                });



            $.ajax({
                type: 'get',
                url: '/user/temp',
                data: Object.assign({},$data), // change array to object
                dataType: 'json',
                success: function(res){
                    if(res.status== 'success'){
                        location.href= "/user/payment";
                    }
                }
            })





            })

        })
    </script>
@endsection
