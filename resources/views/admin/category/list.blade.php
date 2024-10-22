@extends('admin.layouts.master')

@section('pageContent')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-primary">Category List</h1>
        </div>

        {{-- input form --}}
        <div class="">
            <div class="row">
                <div class="col-4">
                    <form action=" {{route('category#create')}} " method="POST">
                        @csrf
                        <input type="text"  class="form-control @error('categoryName') is-invalid @enderror"  placeholder="Category Name..." name="categoryName">
                        @error('categoryName')
                            <small class="text-danger"> {{ $message }} </small><br>
                        @enderror
                        <input type="submit" value="Create" class="btn btn-outline-primary mt-3">
                    </form>
                </div>
                <div class="col-6 offset-1">
                    <table class="table-hover table table-bordered">
                        <thead>
                            <tr class="bg-primary text-white text-center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Created at</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                    @foreach ($categories as $category )
                        <tbody>
                            <tr>
                                <td> {{ $category->id }} </td>
                                <td> {{ $category->name }} </td>
                                <td> {{ $category->created_at }} </td>
                                <td class="text-center"><a href=" {{ route('category#updatePage', $category->id) }} "><i class="bi bi-pencil-square text-primary"></i></a></td>
                                <td class="text-center"><a href=" {{ route('category#delete', $category->id) }} "><i class="bi bi-trash3 text-danger"></i></a></td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
                <div class="d-flex justify-content-end"> {{ $categories->links() }} </div>
                </div>
            </div>

        </div>

    </div> <!--- extra -->


@endsection

