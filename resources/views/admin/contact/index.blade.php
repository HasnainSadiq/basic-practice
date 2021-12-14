@extends('admin.admin_master')
@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <h4>Contact Page</h4>
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
                            <h3> Home</h3>
                            <a href="{{ route('add.contact')}}">
                                <button class=" btn btn-info my-2 my-sm-0">Add </button>
                            </a>

                        </div>

<table class="table">
    <thead>
        <tr>
            <th scope="col" width="6%">Sl No</th>
            <th scope="col " width="18%">Email</th>
            <th scope="col " width="15%">Phone</th>
            <th scope="col" width="30%">Address</th>
            <th scope="col">Created_at</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @php($i = 1)
        @foreach ($contacts as $cont)
            <tr>
                <td scope="row">{{ $i++ }}</td>
                <td>{{ $cont->email}}</td>
                <td>{{ $cont->phone}}</td>
                <td>{{ $cont->address }}</td>

                {{-- <td >{{ substr($slider->description, 0, 63) }}</td> --}}

                <td>
                    @if ($cont->created_at == null)
                        <span class="text-danger">No Date Set</span>
                    @else

                        {{-- quer builder method --}}
                        {{ carbon\carbon::parse($cont->created_at)->diffForHumans() }}


                        {{-- Elequent Method --}}
                        {{-- {{$brand->created_at->diffForHumans()}} --}}

                    @endif
                </td>
                <td>
                    <a href="{{ url('contact/edit/' . $cont->id) }}"
                        class="btn btn-info">Edit</a>
                    <a href="{{ url('contact/delete/' . $cont->id) }}"
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
