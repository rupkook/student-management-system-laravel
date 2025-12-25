@extends("backend.layouts.app")

@section("content")
<div class="container my-5">

    <!-- Back Button -->
    <div class="mb-4">
        <a class="btn btn-secondary" href="{{ route('backend.index') }}">← Back</a>
    </div>

    <!-- Add Post Card -->
    <div class="card shadow-lg p-4">
        <div class="card-body">
            <h2 class="mb-4">Add New Post</h2>

            <!-- Session Message -->
            @if(session('msg'))
                <div class="alert alert-success">{{ session('msg') }}</div>
            @endif

            <!-- Add Post Form -->
            <form action="{{ route('backend.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input name="title" id="title" class="form-control" type="text" placeholder="Enter post title">
                </div>

                <div class="mb-3">
                    <label for="post_content" class="form-label">Content</label>
                    <textarea name="post_content" id="post_content" class="form-control" rows="5" placeholder="Enter post content"></textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input name="image" id="image" class="form-control" type="file">
                </div>

                <div>
                    <button class="btn btn-primary px-4">Add Post</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
