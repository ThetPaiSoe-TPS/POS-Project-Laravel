@extends('user.layouts.master')

@section('content')
    <div class="container my-5" >
        <h1 style="margin-top: 200px" class="text-center pri-color"><span>Contact Form</span></h1>
            <form action="{{route('user#contactForm')}}" class="mt-3 py-5" method="post">
                @csrf
                <div class="col-10 offset-2">
                    <div class="row">
                        <div class="col-4 mx-5">
                            <div class="row ">
                                <label for="" class="mb-3 fw-bold">Title</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div class="row my-4">
                                <label for="" class="mb-3 fw-bold" >Name</label>
                                <input type="text" class="form-control bg-white" name="name" readonly placeholder="{{Auth::user()->name}}">
                            </div>
                            <div class="row ">
                                <label for="" class="mb-3 fw-bold">Email</label>
                                <input type="text" class="form-control bg-white" name="email" readonly placeholder="{{Auth::user()->email}}">
                                <span class="" style="color: #8da1af">example@example.com</span>
                            </div>
                            <div>
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            </div>

                        </div>
                        <div class="col-6 mx-3">
                            <label for="" class="mb-3 fw-bold">Message: <span class="text-danger">*</span></label>
                            <textarea name="message" id="" cols="30" rows="10" class="form-control" ></textarea>
                        </div>
                        <div class=" d-flex justify-content-center mt-5">
                            <input type="submit" value="Send" class="btn w-25 btn-lg text-white" style="background: #3d719b">
                        </div>

                    </div>
                </div>
            </form>
    </div>
@endsection
