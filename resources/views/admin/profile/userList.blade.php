@extends('admin.layouts.master')

@section('pageContent')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 "><a href="{{route('profile#user#list')}}"><span class="bg-primary p-3 text-white rounded-sm">User List</span></a></h1>
        </div>

        {{-- input form --}}
        <div class="">
            <div class="row">
                <div class="col-10 offset-1">
                    <div class="d-flex justify-content-between">
                        <div class="user-list">
                            <a href="{{route('profile#admin#list')}}" class="btn btn-outline-primary"><i class="fa-solid fa-list mr-2"></i>Admin List</a>
                        </div>
                        <div class="">
                            <form action="{{route('profile#user#list')}}" method="get">
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
                            @foreach ($users as $user)
                                <tr>
                                    <td> {{$user->id}} </td>
                                    <td class="text-success"> <b>{{$user->role}}</b> </td>
                                    <td>
                                        @if ($user->name== null) {{$user['nickname']}} @endif
                                        @if ($user->name!== null) {{$user->name}} @endif
                                        {{-- can write two ways  --}}
                                    </td>
                                    <td> {{$user->email}} </td>
                                    <td class="text-center">
                                        @if ($user->provider== 'google')
                                            <img src="{{asset('admin/img/google-symbol.png')}}" alt="">
                                        @endif

                                        @if ($user->provider== 'github')
                                            <i class="fa-brands fa-github text-dark h2"></i>

                                        @endif

                                        @if ($user->provider== null)
                                        <i class="fa-solid fa-circle-exclamation "></i>
                                        @endif
                                    </td>
                                    <td> {{$user->phone}} </td>
                                    <td> {{$user->address}} </td>
                                    <td> {{$user->created_at}} </td>
                                    <td class="text-center"><a href="{{route('profile#user#delete', $user->id)}}"><i class="bi bi-trash3 text-danger"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>

                </table>
                {{-- <div class="d-flex justify-content-end"> {{$admins->links()}} </div> --}}
                </div>
            </div>

        </div>

    </div> <!--- extra -->


@endsection

