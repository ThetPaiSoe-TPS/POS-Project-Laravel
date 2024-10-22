@extends('admin.layouts.master')

@section('pageContent')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="">
                    <h3 class="h3 my-3 text-center"><a href="{{route('profile#accountProfile#page')}}"><span class="bg-primary p-3 text-white rounded-sm">Account Information</span></a></h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-3">
                        <img src="{{asset(Auth::user()->profile== null? 'admin/img/undraw_profile.svg': 'profile/'.Auth::user()->profile)}}" class="img-profile img-thumbnail w-75" alt="">
                    </div>
                    <div class="col-5">
                        <div class="row">
                            <div class="d-flex flex-column col-auto text-primary">
                                <b>Name:</b>
                                <b>Role:</b>
                                <b>Email:</b>
                                <b>Phone:</b>
                                <b>Address:</b>
                                <b>Registred Time:</b>
                            </div>
                            <div class="d-flex flex-column col-auto text-primary">
                                <span class=""> {{Auth::user()->name? Auth::user()->name: Auth::user()->nickname}} </span>
                                <span> <b class="text-success">{{Auth::user()->role}}</b> </span>
                                <span> {{Auth::user()->email}} </span>
                                <span> {{Auth::user()->phone}}</span>
                                <span> {{Auth::user()->address}}</span>
                                <span> {{Auth::user()->created_at}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <div>
                <a href=" {{route('profile#edit')}} " class="btn btn-outline-primary"><i class="fa-regular fa-pen-to-square mx-1"></i>Edit Profile</a>
                <a href="{{route('profile#changepassword#page')}}" class="btn btn-outline-primary"><i class="fa-solid fa-key mx-1"></i>Change Password</a>
            </div>
    </div>
@endsection


