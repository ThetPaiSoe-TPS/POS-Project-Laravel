@extends('admin.layouts.master')

@section('pageContent')
    <div class="container">
        <div class="row">
            <div class="card col-6 offset-3 shadow-sm">
                <h1 class="h3 py-3 mt-3 text-center"><a href="{{route('profile#createNewAdminAccount')}}"><span class="bg-primary p-3 text-white rounded-sm">New Admin Account</span></a></h1>
                <div class="d-flex justify-content-center">
                    <a class="btn btn-outline-primary " href="{{route('profile#admin#list')}}" >
                        <i class="fa-solid fa-user"></i>
                        Admin List
                        <i class="fa-solid fa-list"></i>
                    </a>
                </div>
                <form action="{{route('profile#createAdminAccount')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="type" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Enter Name...">
                            @error('name')
                                <small class="text-danger invalid-feedback"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="Enter Email...">
                            @error('email')
                                <small class="text-danger invalid-feedback"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password...">
                            @error('password')
                                <small class="text-danger invalid-feedback"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Confirm Password</label>
                            <input type="password" name="confirmPassword" class="form-control @error('confirmPassword') is-invalid @enderror"  placeholder="Enter Confirm Password...">
                            @error('confirmPassword')
                                <small class="text-danger invalid-feedback"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-block">Create</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
