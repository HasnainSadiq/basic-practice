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
                        <div class="card-header">Edit Contact</div>
                        <div class="card-body">
                            <form action="{{ url('contact/update/' . $cont->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Update Contact Email</label>
                                    <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ $cont->email }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Update Contact Phone NO</label>
                                    <input type="text" name="phone" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ $cont->phone }}">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Update Address</label>
                                    <textarea class="form-control" name="address"
                                        id="exampleFormControlTextarea1"
                                        rows="3">{{ $cont->address }}</textarea>
                                </div>
                                <button type="submit" class="my-2 btn btn-primary">Update contact</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
