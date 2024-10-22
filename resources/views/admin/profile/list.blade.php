@extends('admin.layouts.master')

@section('pageContent')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0"><a href="{{route('profile#admin#list')}}"><span class="bg-primary p-3 text-white rounded-sm">Admin List</span></a></h1>
        </div>

        {{-- input form --}}
        <div class="">
            <div class="row">
                <div class="col-10 offset-1">
                    <div class="d-flex justify-content-between">
                        <div class="user-list">
                            <a href="{{route('profile#user#list')}}" class="btn btn-outline-primary"><i class="fa-solid fa-list mr-2"></i>User List</a>
                        </div>
                        <div class="">
                            <form action="{{route('profile#admin#list')}}" method="get">
                                @csrf
                                <div class="mb-3 d-flex align-items-center">
                                    <input type="text" name="search" value="{{request('search')}}" placeholder="search..." id="" class="form-control">
                                    <button class="btn btn-primary"><i class="fa fa-magnifying-glass bg-primary text-white "></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table-hover table table-bordered">
                        <thead>
                            <tr class="bg-primary text-white text-center">
                                <th>ID</th>
                                <th>Role</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Platform</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Created Date</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td> {{$admin->id}} </td>
                                    <td @if (Auth::user()->id== $admin->id) class= 'text-success' @endif> <b>{{$admin->role}}</b> </td>
                                    <td>
                                        @if ($admin->name == null) {{ $admin->nickname }} @endif
                                        @if ($admin->name !== null) {{ $admin->name }} @endif
                                    </td>
                                    <td> {{$admin->email}} </td>
                                    <td class="text-center">
                                        @if ($admin['provider']== 'google')
                                        <img src="{{asset('admin/img/google-symbol.png')}}" alt="">
                                        @endif
                                        @if ($admin['provider']== 'github')
                                            <i class="fa-brands fa-github text-dark h2"></i>
                                        @else
                                            <i class="fa-brands fa-laravel text-danger h2"></i>
                                        @endif

                                    </td>
                                    <td> {{$admin->phone}} </td>
                                    <td> {{$admin->address}} </td>
                                    <td> {{$admin->created_at}} </td>
                                    {{-- @if ($admin['role']!== 'superadmin')
                                        <td class="text-center"><a href=""><i class="bi bi-trash3 text-danger"></i></a></td>
                                    @endif --}}
                                    {{-- another way of disable button for if not superadmin --}}
                                    <td>
                                        <a href="{{route('profile#delete', $admin['id'])}}" >
                                            {{-- <button class="btn btn-sm" @if ($admin['role']== 'superadmin') disabled @endif>
                                                <i class="bi bi-trash3  text-danger"></i>
                                            </button> --}}

                                            {{-- or using current user's id and looping id (cannot delete itself account) --}}
                                            {{-- <button class="btn btn-sm" @if (Auth::user()->id== $admin['id']) disabled @endif>
                                                <i class="bi bi-trash3 text-danger"></i>
                                            </button> --}}

                                            {{-- or like this --}}
                                            <button class="btn btn-sm" @if (Auth::user()->id== $admin['id']) disabled @endif>
                                                <i class="bi bi-trash3 @if (Auth::user()->id== $admin['id']) text-muted @endif @if (Auth::user()->id!== $admin['id']) text-danger @endif "></i>
                                            </button>

                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                </table>
                <div class="d-flex justify-content-end"> {{$admins->links()}} </div>
                </div>
            </div>

        </div>

    </div> <!--- extra -->


@endsection

