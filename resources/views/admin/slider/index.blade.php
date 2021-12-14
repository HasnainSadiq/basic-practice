@extends('admin.admin_master')
@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <h4>Home Slider</h4>
                <br>
                <br>
                <div class="col-12">
                    <div class="card">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong> .
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>

                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('error') }}</strong> .
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>

                            </div>
                        @endif
                        <div class="card-header align-items-center d-flex justify-content-between">
                            <h3>All Slider</h3>
                            <a href="{{ route('add.slider') }}">
                                <button class=" btn btn-info my-2 my-sm-0">Add Slider</button>
                            </a>

                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" >Sl No</th>
                                    <th scope="col" width="10%">Slider Title</th>
                                    <th scope="col "width="30%">Description</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Created_at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
            <tbody>
                @php($i = 1)
                @foreach ($sliders as $slider)
                    <tr>
                        <td scope="row">{{ $i++ }}</td>
                        <td>{{ $slider->title }}</td>
                        <td>{{ $slider->description }}</td>
                        {{-- <td >{{ substr($slider->description, 0, 63) }}</td> --}}
                        <td> <img src="{{ asset($slider->image) }}" style="height: 40px; width:70px;">
                        </td>
                        <td>
                            @if ($slider->created_at == null)
                                <span class="text-danger">No Date Set</span>
                            @else

                                {{-- quer builder method --}}
                                {{ carbon\carbon::parse($slider->created_at)->diffForHumans() }}


                                {{-- Elequent Method --}}
                                {{-- {{$brand->created_at->diffForHumans()}} --}}

                            @endif
                        </td>
                        <td>
                            <a href="{{ url('slider/edit/' . $slider->id) }}"
                                class="btn btn-info">Edit</a>
                            <a href="{{ url('slider/delete/' . $slider->id) }}"
                                onclick="return confirm('Are you sure to delete')"
                                class="btn btn-danger">Delete</a>
                        </td>

                    </tr>
                @endforeach

            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection
