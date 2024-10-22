@extends('admin.layouts.master')

@section('pageContent')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-primary">Payment List</h1>
        </div>

        {{-- input form --}}
        <div class="">
            <div class="row">
                <div class="col-4 offset-1">
                    <form action=" {{route('payment#create')}} " method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Account Name</label>
                            <input type="type"  class="form-control @error('accountName') is-invalid @enderror" value="{{old('accountName')}}"  placeholder="Account Name..." name="accountName">
                            @error('accountName')
                                <small class="text-danger"> {{ $message }} </small><br>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Account Number</label>
                            <input type="number"  class="form-control @error('accountNumber') is-invalid @enderror"  value="{{old('accountNumber')}}" placeholder="Account Number..." name="accountNumber">
                            @error('accountNumber')
                                <small class="text-danger"> {{ $message }} </small><br>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Bank Name</label> <br>
                                <select name="accountType" id="" class="@error('accountType') is-invalid @enderror form-control" >
                                    <option value="">Select Bank Name...</option>
                                    <option value="kBZpay">KBZpay</option>
                                    <option value="AyarPay">AyarPay</option>
                                    <option value="WavePay">WavePay</option>
                                    <option value="TrueMoney">TrueMoney</option>
                                </select>
                            @error('accountType')
                                <small class="text-danger"> {{ $message }} </small><br>
                            @enderror
                        </div>
                        <input type="submit" value="Create" class="btn btn-outline-primary mt-3">
                    </form>
                </div>
                <div class="col-6 mt-4">
                    <table class="table-hover table table-bordered">
                        <thead>
                            <tr class="bg-primary text-white text-center" >
                                <th>ID</th>
                                <th>Account Name</th>
                                <th>Account Number</th>
                                <th>Bank Name</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                    @foreach ($payments as $payment)
                        <tbody>
                            <tr>
                                <td> {{$payment->id}} </td>
                                <td> {{$payment->account_name}} </td>
                                <td> {{$payment->account_number}} </td>
                                <td> {{$payment->type}} </td>
                                <td class="text-center"><a href=""><i class="bi bi-pencil-square text-primary"></i></a></td>
                                <td class="text-center"><a href=""><i class="bi bi-trash3 text-danger"></i></a></td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
                <div class="d-flex justify-content-end"> {{$payments->links()}} </div>
                </div>
            </div>

        </div>

    </div> <!--- extra -->


@endsection

