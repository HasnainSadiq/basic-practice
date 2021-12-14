@extends('admin.admin_master')
@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
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
                            <h3 class="text-info"> Users Messages</h3>


                        </div>

<table class="table">
    <thead>
        <tr>
            <th scope="col" width="6%">Sl No</th>
            <th scope="col " width="10%">name</th>
            <th scope="col " width="15%">Email</th>
            <th scope="col " width="20%">subject</th>
            <th scope="col" width="30%">message</th>
            <th scope="col">Created_at</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @php($i = 1)
        @foreach ($messages as $cont)
            <tr>
                <td scope="row">{{ $i++ }}</td>
                <td>{{ $cont->name}}</td>
                <td>{{ $cont->email}}</td>
                <td>{{ $cont->subject}}</td>
                <td>{{ $cont->message }}</td>

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

                    <a href="{{ url('message/delete/' . $cont->id) }}"
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
