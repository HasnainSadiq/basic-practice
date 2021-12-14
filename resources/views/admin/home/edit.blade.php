@extends('admin.admin_master')
@section('admin')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong> .
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="py-12">
        <div class="container">
            <div class="row">

                <div class="col-8">
                    <div class="card">
                        <div class="card-header">Edit About</div>
                        <div class="card-body">
                            <form action="{{ url('about/update/' . $homeabout->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Update About Title</label>
                                    <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ $homeabout->title }}">

                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Update Short Discription</label>
                                    <textarea class="form-control" name="short_discription"
                                        id="exampleFormControlTextarea1"
                                        rows="3">{{ $homeabout->short_discription }}</textarea>

                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Update long Description</label>
                                    <textarea class="form-control" name="long_discription"
                                        id="exampleFormControlTextarea1"
                                        rows="3">{{ $homeabout->long_discription }}</textarea>

                                </div>



                                <button type="submit" class="my-2 btn btn-primary">Update About</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
