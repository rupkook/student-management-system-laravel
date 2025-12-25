@extends("backend.layouts.app")

@section("content")
<div class="container my-5">

    <!-- Back Button -->
    <div class="mb-4">
        <a class="btn btn-danger" href="{{ route('backend.index') }}">← Back</a>
    </div>

    <!-- Search Form -->
    <div class="card shadow-lg mb-4 p-3">
        <form action="{{ route('back.search.post') }}" method="POST" class="d-flex flex-wrap gap-2">
            @csrf
            <input class="form-control flex-grow-1" type="text" name="search" placeholder="Search posts...">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
    </div>

    <!-- Search Results -->
    <div class="card shadow-lg">
        <div class="card-body">
            <h2 class="mb-3 text-primary">Search Results</h2>

            <!-- Session Message -->
            @if(session('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Results Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($result_data->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center text-danger">No data found.</td>
                        </tr>
                        @else
                        @foreach ($result_data as $index => $posts)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ Str::limit($posts->title, 30) }}</td>
                            <td>{{ Str::limit($posts->content, 50) }}</td>
                            <td>
                                @if($posts->images)
                                    <img src="{{ asset('uploads/posts/' . $posts->images) }}" alt="Post Image" class="img-thumbnail" style="width: 80px; height: 50px; object-fit: cover;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td class="d-flex gap-2 flex-wrap">
                                <a class="btn btn-sm btn-info" href="{{ route('back.single.post', ['id'=> $posts->id]) }}">View</a>
                                <a class="btn btn-sm btn-warning" href="{{ route('back.edit.post', ['id'=> $posts->id]) }}">Edit</a>
                                <a class="btn btn-sm btn-danger" href="{{ route('back.trash.post', ['id'=> $posts->id]) }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

@endsection