@extends('admin.layouts.master')

@section('pageContent')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category Update</h1>
        </div>

        {{-- input form --}}
        <div class="">
            <div class="row">
                <div class="col-4 offset-2">
                    <form action=" {{ route('category#update', $category->id) }} " method="POST">
                        @csrf
                        <input type="text" value="{{ old('categoryName', $category->name) }}" class="form-control @error('categoryName') is-invalid @enderror"  placeholder="Category Name..." name="categoryName">
                        @error('categoryName')
                            <small class="text-danger"> {{ $message }} </small><br>
                        @enderror
                            <input type="submit" value="Update" class="btn btn-outline-primary mt-3">
                            <a href="{{ route('category#list') }}" class="btn btn-outline-dark mt-3">Back</a>
                    </form>
                </div>
            </div>

        </div>

    </div> <!--- extra -->


@endsection

