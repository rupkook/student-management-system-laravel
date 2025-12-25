@extends("backend.layouts.app")

@section("content")
<div class="container my-5">

    <!-- Action Buttons -->
    <div class="mb-4 d-flex flex-wrap gap-2">
        <a class="btn btn-primary" href="{{ route('backend.create') }}">Add New Post</a>
        <a class="btn btn-danger" href="{{ route('backend.index') }}">Back</a>
        <a class="btn btn-success" href="{{ route('front.page.index') }}">Go to Main URL</a>
    </div>

    <!-- Trash Posts Table -->
    <div class="card shadow-lg">
        <div class="card-body">
            <h2 class="mb-3 text-primary">Trash Posts</h2>

            <!-- Session Message -->
            @if(session('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('msg') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
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
                        @if($trash_data->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center text-muted">No trash or deleted data found.</td>
                        </tr>
                        @else
                        @foreach ($trash_data as $index => $posts)
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
                                <a class="btn btn-sm btn-warning" href="{{ route('back.restore.post', ['id'=> $posts->id]) }}">Restore</a>
                                <a class="btn btn-sm btn-danger" href="{{ route('back.delete.post', ['id'=> $posts->id]) }}">Delete Permanently</a>
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
