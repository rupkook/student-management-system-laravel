@extends("backend.layouts.app")

@section("content")
<div class="container my-5">

    <!-- Action Buttons -->
    <div class="mb-4 d-flex flex-wrap gap-3">
        <a class="btn btn-primary rounded-pill px-4 py-2" href="{{ route('backend.create') }}">Add New Post</a>
        <a class="btn btn-danger rounded-pill px-4 py-2 d-flex align-items-center" href="{{ route('back.trash.page') }}">
            Trash <span class="badge bg-light text-dark ms-2">{{ $trash_post_collections }}</span>
        </a>
        <a class="btn btn-success rounded-pill px-4 py-2" href="{{ route('front.page.index') }}">Go to Main URL</a>
    </div>

    <!-- Search Form -->
    <div class="card mb-4 shadow-sm border-0" style="border-radius: 12px; background: linear-gradient(145deg, #f8f9fa, #e9ecef);">
        <div class="card-body">
            <form action="{{ route('back.search.post') }}" method="POST" class="d-flex gap-2 flex-wrap">
                @csrf
                <input class="form-control flex-grow-1 rounded-pill" type="text" name="search" placeholder="Search posts...">
                <button class="btn btn-primary rounded-pill px-4">Search</button>
            </form>
        </div>
    </div>

    <!-- Post Table -->
    <div class="card shadow-lg border-0" style="border-radius: 12px;">
        <div class="card-body">
            <h3 class="mb-3 text-primary">All Posts</h3>

            <!-- Session Message -->
            @if(session('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Photo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($post_data->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center text-danger">No data found.</td>
                        </tr>
                        @else
                        @foreach ($post_data as $index => $posts)
                        <tr class="align-middle" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ Str::limit($posts->title, 30) }}</td>
                            <td>{{ Str::limit($posts->content, 50) }}</td>
                            <td>
                                @if($posts->images)
                                <img src="{{ asset('uploads/posts/' . $posts->images) }}" alt="Post Image"
                                    class="img-thumbnail" style="width: 100px; height: 60px; object-fit: cover;">
                                @else
                                <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td class="d-flex gap-2 flex-wrap justify-content-center">
                                <a class="btn btn-sm btn-info rounded-pill px-3" href="{{ route('back.single.post', ['id'=> $posts->id]) }}">View</a>
                                <a class="btn btn-sm btn-warning rounded-pill px-3" href="{{ route('back.edit.post', ['id'=> $posts->id]) }}">Edit</a>
                                <a class="btn btn-sm btn-danger rounded-pill px-3" href="{{ route('back.trash.post', ['id'=> $posts->id]) }}">Delete</a>
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
