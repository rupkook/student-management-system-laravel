@extends("backend.layouts.app")

@section("content")
<div class="container my-5">

    <!-- Back Button -->
    <div class="mb-4">
        <a class="btn btn-secondary" href="{{ route('backend.index') }}">← Back</a>
    </div>

    <!-- Edit Card Form -->
    <div class="card shadow-lg p-4">
        <div class="card-body">
            <h2 class="mb-4">Edit Card</h2>

            <!-- Session Message -->
            @if(session('msg'))
                <div class="alert alert-success">{{ session('msg') }}</div>
            @endif

            <!-- Form -->
            <form action="{{ route('backend.update', ['id'=> $edit_data->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input name="title" id="title" class="form-control" type="text" value="{{ $edit_data->title }}">
                </div>

                <div class="mb-3">
                    <label for="post_content" class="form-label">Content</label>
                    <textarea name="post_content" id="post_content" class="form-control" rows="5">{{ $edit_data->content }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="new_image" class="form-label">Image</label>
                    <input name="new_image" id="new_image" class="form-control mb-2" type="file">
                    
                    <!-- Current Image Preview -->
                    @if($edit_data->images)
                        <div class="mb-2">
                            <p>Current Image:</p>
                            <img src="{{ asset('uploads/posts/' . $edit_data->images) }}" alt="Current Image" class="img-thumbnail" style="max-width: 150px; height: auto;">
                        </div>
                    @endif

                    <input name="old_image" type="hidden" value="{{ $edit_data->images }}">
                </div>

                <button class="btn btn-primary px-4">Update</button>
            </form>
        </div>
    </div>

</div>
@endsection