<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Link</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Link</h1>

        <!-- Error Message -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Edit Link Form -->
        <form action="{{ route('links.update', $link->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="original_url" class="form-label">Original URL</label>
                <input type="url" name="original_url" id="original_url" class="form-control" value="{{ $link->original_url }}" required>
            </div>
            <div class="mb-3">
                <label for="custom_slug" class="form-label">Custom Slug</label>
                <input type="text" name="custom_slug" id="custom_slug" class="form-control" value="{{ str_replace(url('/link/'), '', $link->shortened_url) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Link</button>
            <a href="{{ route('links.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
