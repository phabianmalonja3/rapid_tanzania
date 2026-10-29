<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="row g-3">

        {{-- Title --}}
        <div class="col-md-6">
            <label for="title" class="form-label">
                Activity Title <span class="text-danger">*</span>
            </label>

            <input
                type="text"
                name="title"
                id="title"
                class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $gallery->title) }}"
                placeholder="e.g. Community Cleaning Activity"
                required
            >

            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Category --}}
        <div class="col-md-6">
            <label for="category" class="form-label">Category</label>

            <input
                type="text"
                name="category"
                id="category"
                class="form-control @error('category') is-invalid @enderror"
                value="{{ old('category', $gallery->category) }}"
                placeholder="e.g. Environment, Education"
            >

            @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Activity Date --}}
        <div class="col-md-6">
            <label for="activity_date" class="form-label">Activity Date</label>

            <input
                type="date"
                name="activity_date"
                id="activity_date"
                class="form-control @error('activity_date') is-invalid @enderror"
                value="{{ old('activity_date', $gallery->activity_date?->format('Y-m-d')) }}"
            >

            @error('activity_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Location --}}
        <div class="col-md-6">
            <label for="location" class="form-label">Location</label>

            <input
                type="text"
                name="location"
                id="location"
                class="form-control @error('location') is-invalid @enderror"
                value="{{ old('location', $gallery->location) }}"
                placeholder="e.g. Dar es Salaam, Tanzania"
            >

            @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description --}}
        <div class="col-12">
            <label for="description" class="form-label">
                Description <span class="text-danger">*</span>
            </label>

            <textarea
                name="description"
                id="description"
                rows="5"
                class="form-control @error('description') is-invalid @enderror"
                placeholder="Describe the activity..."
                required
            >{{ old('description', $gallery->description) }}</textarea>

            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Image --}}
        <div class="col-12">
            <label for="image" class="form-label">
                Activity Image
                @if (!$gallery->exists)
                    <span class="text-danger">*</span>
                @endif
            </label>

            <input
                type="file"
                name="image"
                id="image"
                accept="image/*"
                class="form-control @error('image') is-invalid @enderror"
                @if (!$gallery->exists) required @endif
            >

            <small class="text-muted">
                Upload an image in JPG, JPEG, PNG, or WebP format.
                Maximum size: 2 MB.
            </small>

            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($gallery->image)
                <div class="mt-3">
                    <p class="mb-2">Current Image</p>

                    <img
                        src="{{ asset('storage/' . $gallery->image) }}"
                        alt="{{ $gallery->title }}"
                        style="width: 200px; height: 140px; object-fit: cover; border-radius: 8px;"
                    >
                </div>
            @endif
        </div>

        {{-- Buttons --}}
        <div class="col-12 mt-4">
            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-1"></i>

                    {{ $gallery->exists ? 'Update Gallery Activity' : 'Save Gallery Activity' }}
                </button>

                <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
            </div>
        </div>

    </div>
</form>