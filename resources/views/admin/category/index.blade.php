<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong> .
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="card-header">All Category</div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Sl No</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User Id</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php ($i = 1) --}}
                                @foreach ($categories as $category)
                                    <tr>
                                        {{-- <th scope="row">{{ $i++}}</th> --}}
                                        <td scope="row">{{ $categories->firstItem() + $loop->index }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->user_id }}</td>

                                        {{-- Elequent Method --}}
                                        <td>{{ $category->user->name }}</td>

                                        {{-- Query Builder --}}
                                        {{-- <td>{{ $category->name }}</td> --}}

                                        <td>
                                            @if ($category->created_at == null)
                                                <span class="text-danger">No Date Set</span>
                                            @else

                                                {{-- quer builder method --}}
                                                {{ carbon\carbon::parse($category->created_at)->diffForHumans() }}


                                                {{-- Elequent Method --}}
                                                {{-- {{$category->created_at->diffForHumans()}} --}}

                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url ('category/edit/'.$category->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-danger">Delete</a>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">Add Category</div>
                        <div class="card-body">
                            <form action="{{ route('store.category') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category Name</label>
                                    <input type="text" name="category_name" class="form-control"
                                        id="exampleInputEmail1" aria-describedby="emailHelp">

                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="my-2 btn btn-primary">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>








        {{-- Trash Part --}}
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="card">


                        <div class="card-header">Trashed List</div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Sl No</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User Id</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php ($i = 1) --}}
                                @foreach ($trachCat as $category)
                                    <tr>
                                        {{-- <th scope="row">{{ $i++}}</th> --}}
                                        <td scope="row">{{ $categories->firstItem() + $loop->index }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->user_id }}</td>

                                        {{-- Elequent Method --}}
                                        <td>{{ $category->user->name }}</td>

                                        {{-- Query Builder --}}
                                        {{-- <td>{{ $category->name }}</td> --}}

                                        <td>
                                            @if ($category->created_at == null)
                                                <span class="text-danger">No Date Set</span>
                                            @else

                                                {{-- quer builder method --}}
                                                {{ carbon\carbon::parse($category->created_at)->diffForHumans() }}


                                                {{-- Elequent Method --}}
                                                {{-- {{$category->created_at->diffForHumans()}} --}}

                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url ('category/restore/'.$category->id)}}" class="btn btn-info">Restore</a>
                                            <a href="{{ url ('category/pdelete/'.$category->id)}}" class="btn btn-danger">P Delete</a>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $trachCat->links() }}
                    </div>
                </div>
                <div class="col-4">

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
