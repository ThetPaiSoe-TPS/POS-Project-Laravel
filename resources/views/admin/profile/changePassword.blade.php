@extends('admin.layouts.master')

@section('pageContent')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 py-3 "><a href="{{route('profile#changepassword#page')}}"><span class="bg-primary p-3 text-white rounded-sm">Change Password</span></a></h1>
        </div>

        {{-- input form --}}
        <div class="">
            <div class="row">
                <div class="col-4 offset-2">
                    <form action=" {{ route('profile#changepassword') }} " method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="password" name="oldPassword" class="form-control @error('oldPassword') is-invalid @enderror" placeholder="old password...">
                            @error('oldPassword')
                                <small class="text-danger invalid-feedback"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="password" name="newPassword" class="form-control @error('newPassword') is-invalid @enderror" placeholder="new password...">
                            @error('newPassword')
                                <small class="text-danger invalid-feedback"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="password" name="confirmPassword" class="form-control @error('confirmPassword') is-invalid @enderror" placeholder="confirm password...">
                            @error('confirmPassword')
                                <small class="text-danger invalid-feedback"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div>
                            <input type="submit" class="btn btn-primary" value="Change">
                            <a href="{{route('profile#accountProfile#page')}}" class="btn btn-dark">Back</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div> <!--- extra -->


@endsection

