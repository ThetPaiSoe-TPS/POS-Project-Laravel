@extends('user.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid" style="margin-top: 180px">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-primary">User Payment</h1>
        </div>

        {{-- input form --}}
        <div class="container mx-auto">
            <div class="row">
                <div class="col-4 offset-1">
                    <h3>Payment Methods</h3>
                    @foreach ($payments as $payment)
                        <div>
                            <b> <span> {{$payment->type}} </span> ({{$payment->account_name}}) </b>
                            <p> <span>Account: </span> {{$payment->account_number}} </p>
                        </div>
                        <hr class="divide-gray-300">
                    @endforeach
                </div>
                <div class="col-6 mt-4">
                    <div class="card">
                        <div class="card-header"><h5 class="text-center">Payment Info</h5></div>
                        <div class="card-body ">
                            <form action="{{route('payment#order')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row my-3 px-3">
                                    <input type="text" placeholder="{{Auth::user()->name}}" readonly name="userName" class="form-control bg-white w-50 @error('userName') is-invalid @enderror" value={{old('userName')}}>
                                    <input type="tel" name="phone" id="" class="form-control w-50 @error('phone') is-invalid @enderror" placeholder="Enter Phone Number..." value="{{old('phone', Auth::user()->phone)}}">
                                    <div class="d-flex justify-content-between">
                                        @error('userName')
                                            <small class="text-danger"> {{$message}} </small>
                                        @enderror
                                        @error('phone')
                                            <small class="text-danger"> {{$message}} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row my-3 px-3">
                                    @foreach($orderProduct as $odrPdt)
                                        <input type="hidden" name="productId" value="{{$odrPdt['product_id']}}">
                                    @endforeach
                                    <input type="text" placeholder="Address..." name="address" class="form-control w-50 @error('address') is-invalid @enderror" value={{old('address', Auth::user()->address)}}>
                                    <select name="paymentMethod" id="" class="form-select w-50 @error('paymentMethod') is-invalid @enderror" >
                                        <option value="">Choose payment method...</option>
                                        @foreach ($payments as $payment)
                                            <option value={{$payment->type}} @if(old('paymentMethod')== $payment->type) selected @endif > {{$payment->type}} </option>
                                        @endforeach
                                    </select>
                                    <div class="d-flex justify-content-between">
                                        @error('address')
                                            <small class="text-danger"> {{$message}} </small>
                                        @enderror
                                        @error('paymentMethod')
                                            <small class="text-danger"> {{$message}} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row my-3 px-3">
                                    <input type="file" name="paySlip" id="" class="form-control w-50 @error('paySlip') is-invalid @enderror bg-white">
                                    <div class="d-flex justify-content-between">
                                        @error('paySlip')
                                            <small class="text-danger"> {{$message}} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <input type="hidden" value="{{$orderProduct[0]['total_amount']}}" name="totalAmount">
                                    <input type="hidden" value="{{$orderProduct[0]['order_code']}}" name="orderCode">
                                    <span>Total Amount: </span> <b class="text-primary"> {{$orderProduct[0]['total_amount']}} MMK </b>
                                    <span>Order Code: </span> <b class="text-primary"> {{$orderProduct[0]['order_code']}} </b>
                                </div>

                                <div class="d-flex justify-content-center mt-3">
                                    <button class="btn btn-outline-success w-50 " type="submit"><i class="fa-solid fa-cart-shopping me-2" ></i>Order Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                {{-- <div class="d-flex justify-content-end"> {{$payments->links()}} </div> --}}
                </div>
            </div>

        </div>

    </div> <!--- extra -->


@endsection

