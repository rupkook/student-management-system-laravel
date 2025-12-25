@extends("backend.layouts.app")

@section("content")
<div class="container my-5">

    <!-- Back/Home Button -->
    <div class="mb-4">
        <a class="btn btn-primary" href="{{ route('backend.index') }}">← Home</a>
    </div>

    <!-- Single Post Card -->
    <div class="card shadow-lg border-0" style="border-radius: 12px;">
        <div class="card-body">
            <h2 class="mb-4 text-primary">Post Details</h2>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Photo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $single_post->title }}</td>
                            <td>{{ $single_post->content }}</td>
                            <td>
                                @if($single_post->images)
                                    <img src="{{ asset('uploads/posts/' . $single_post->images) }}" alt="Post Image" class="img-thumbnail" style="width: 120px; height: 80px; object-fit: cover;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


@endsection
