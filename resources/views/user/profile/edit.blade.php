@extends('user.layouts.master')

@section('content')
    <div class="" style="padding-top: 7em"></div>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <div class="text-center">
                    <h3 class="text-primary">Profile Editing</h3>
                    <b class="text-danger"> [{{Auth::user()->role}}] </b>
                </div>
            </div>
            <form action="{{route('profile#update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container col-8">
                    <div class="row">
                        <div class="col-4">
                            <div class="mt-5">
                                <img src="{{asset(Auth::user()->profile==null? 'admin/img/undraw_profile.svg': 'profile/'.Auth::user()->profile)}}" id="output" class="img-profile img-fluid img-thumbnail" alt="">
                            </div>
                            <div class="m-4 mt-3">
                                <input type="file" name="image" id="" class=" @error('image') is-invalid @enderror" onchange="loadFile(event)">
                                @error('image')
                                    <small class="text-danger invalid-feedback"> {{$message}} </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="my-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="name" value="{{old('name', auth()->user()->name== null?auth()->user()->nickname:auth()->user()->name)}}"  class="form-control @error('name') is-invalid @enderror " id="">
                                @error('name')
                                    <small class="text-danger invalid-feedback"> {{$message}} </small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" name="email" value="{{old('email', auth()->user()->email)}}"  class="form-control @error('email') is-invalid @enderror " id="">
                                @error('email')
                                    <small class="text-danger invalid-feedback"> {{$message}} </small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Phone Number</label>
                                <input type="tel" name="phone" value="{{old('phone', auth()->user()->phone)}}"  class="form-control @error('phone') is-invalid @enderror ">
                                @error('phone')
                                    <small class="text-danger invalid-feedback"> {{$message}} </small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Address</label>
                                <input type="text" name="address" value="{{old('address', auth()->user()->address)}}"  class="form-control @error('address') is-invalid @enderror ">
                                @error('address')
                                    <small class="text-danger invalid-feedback"> {{$message}} </small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="submit" value="Change" class="btn btn-primary">
                                <a href="{{route('userHome')}}" class="btn btn-primary"><i class="fa-solid fa-house me-2"></i>Home</a>
                            </div>
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection


