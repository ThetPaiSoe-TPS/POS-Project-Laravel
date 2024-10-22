@extends('user.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid" style="margin-top: 180px">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-primary">Customer Order List</h1>
        </div>

        {{-- input form --}}
        <div class="">
            <div class="row mx-auto">
                <div class="col-8 offset-2 ">

                    <table class="table-hover table table-bordered shadow-sm">
                        <thead>
                            <tr class="bg-primary text-white text-center">
                                <th>Name</th>
                                <th>Order Code</th>
                                <th>Status</th>
                                <th>Ordered Date</th>
                                <th>Remaining Day</th>
                            </tr>
                        </thead>
                    @foreach ($order as $item )
                        <tbody>
                            <tr class="text-center">
                                <td> {{ Auth::user()->name }} </td>
                                <td> {{ $item->order_code }} </td>
                                <td>
                                    @if($item->status== 0)
                                        <span class="badge bg-warning p-2 text-dark"><i class="fa-solid fa-person-biking me-2"></i>Pending</span>
                                    @elseif($item->status== 1)
                                        <span class="badge bg-success p-2"><i class="fa-regular fa-circle-check me-2"></i>Succeeded</span>
                                    @else
                                        <span class="badge bg-danger p-2"><i class="fa-solid fa-circle-exclamation me-2"></i>Rejected</span>
                                    @endif
                                </td>
                                <td> {{ $item->created_at }} </td>
                                <td> 3 days left </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
                <div class="d-flex justify-content-end">  </div>
                </div>
            </div>

        </div>

    </div> <!--- extra -->


@endsection

