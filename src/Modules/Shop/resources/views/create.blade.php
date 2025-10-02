
<div class="container">
    <h1>Create Shop</h1>

    {{-- show errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- success message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('shop.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title">Title</label>
            <input id="title" type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="content">Content</label>
            <textarea id="content" name="content" class="form-control" required>{{ old('content') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image">Image URL</label>
            <input id="image" type="text" name="image" class="form-control" value="{{ old('image') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Shop</button>
    </form>
</div>

