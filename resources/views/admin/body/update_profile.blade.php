@extends('admin.admin_master')
@section('admin')



<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h3 class="text-info">User Update Profile</h3>
    </div>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong> .
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>

    </div>
@endif
    <div class="card-body">
        <form method="POST" action="{{ route('update.user.profile')}}" class="form-pill" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="exampleFormControlInput3">User Nmae</label>
                <input type="text" name="name" class="form-control" value="{{$user['name']}}">
            </div>

            <div class="form-group">
                <label for="exampleFormControlInput3">User Email</label>
                <input type="text" name="email" class="form-control" value="{{$user['email']}}">
            </div>

            <div class="form-group">
                <label for="exampleFormControlInput3">User Profile Picture</label>
                <input type="file" name="profile_photo_path" class="form-control"  value="{{ $user->profile_photo_path }}" >
            </div>

            <button type="submit" class="btn btn-primary btn-default">Update</button>

        </form>
    </div>
</div>



@endsection
