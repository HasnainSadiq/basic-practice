@extends('admin.admin_master')
@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <h4>Home About</h4>
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
                            <h3>Home</h3>
                            <a href="{{ route('add.about') }}">
                                <button class=" btn btn-info my-2 my-sm-0">Add </button>
                            </a>

                        </div>

<table class="table">
    <thead>
        <tr>
            <th scope="col" width="6%">Sl No</th>
            <th scope="col" width="15%"> Title</th>
            <th scope="col " width="20%">short-DIS</th>
            <th scope="col " width="30%">long-DIS</th>
            <th scope="col">Created_at</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @php($i = 1)
        @foreach ($homeabout as $homeabouts)
            <tr>
                <td scope="row">{{ $i++ }}</td>
                <td>{{ $homeabouts->title }}</td>
                <td>{{ $homeabouts->short_discription}}</td>
                <td>{{ $homeabouts->long_discription}}</td>

                {{-- <td >{{ substr($slider->description, 0, 63) }}</td> --}}

                <td>
                    @if ($homeabouts->created_at == null)
                        <span class="text-danger">No Date Set</span>
                    @else

                        {{-- quer builder method --}}
                        {{ carbon\carbon::parse($homeabouts->created_at)->diffForHumans() }}


                        {{-- Elequent Method --}}
                        {{-- {{$brand->created_at->diffForHumans()}} --}}

                    @endif
                </td>
                <td>
                    <a href="{{ url('about/edit/' . $homeabouts->id) }}"
                        class="btn btn-info">Edit</a>
                    <a href="{{ url('about/delete/' . $homeabouts->id) }}"
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
