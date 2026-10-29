
@php
    $isEdit = isset($gallery) && $gallery->exists;
@endphp

<form
    action="{{ $isEdit ? route('gallery.update', $gallery->id) : route('gallery.store') }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="row g-4">

        <div class="col-md-6">
            <label for="title" class="form-label">Activity Title *</label>
            <input
                type="text"
                name="title"
                id="title"
                class="form-control"
                value="{{ old('title', $gallery->title ?? '') }}"
                required
            >
        </div>

        <div class="col-md-6">
            <label for="category" class="form-label">Category</label>
            <input
                type="text"
                name="category"
                id="category"
                class="form-control"
                value="{{ old('category', $gallery->category ?? '') }}"
                placeholder="e.g. Community Outreach"
            >
        </div>

        <div class="col-md-6">
            <label for="activity_date" class="form-label">Activity Date</label>
            <input
                type="date"
                name="activity_date"
                id="activity_date"
                class="form-control"
                value="{{ old('activity_date', isset($gallery) && $gallery->activity_date ? \Carbon\Carbon::parse($gallery->activity_date)->format('Y-m-d') : '') }}"
            >
        </div>

        <div class="col-md-6">
            <label for="location" class="form-label">Location</label>
            <input
                type="text"
                name="location"
                id="location"
                class="form-control"
                value="{{ old('location', $gallery->location ?? '') }}"
                placeholder="Activity location"
            >
        </div>

        <div class="col-12">
            <label for="description" class="form-label">
                Activity Description *
            </label>
            <textarea
                name="description"
                id="description"
                class="form-control"
                rows="6"
                required
            >{{ old('description', $gallery->description ?? '') }}</textarea>
        </div>

        @if ($isEdit && $gallery->image)
            <div class="col-12">
                <label class="form-label">Current Image</label>
                <div class="mb-3">
                    <img
                        src="{{ asset('storage/' . $gallery->image) }}"
                        alt="{{ $gallery->title }}"
                        style="width:100%;max-width:360px;height:220px;object-fit:cover;border-radius:10px;"
                    >
                </div>
            </div>
        @endif

        <div class="col-12">
            <label for="image" class="form-label">
                {{ $isEdit ? 'Replace Image (optional)' : 'Activity Image *' }}
            </label>

            <input
                type="file"
                name="image"
                id="image"
                class="form-control"
                accept="image/jpeg,image/png,image/webp"
                {{ $isEdit ? '' : 'required' }}
            >

            <small class="text-muted">
                JPG, PNG or WEBP. Maximum size: 2 MB.
                @if ($isEdit)
                    Leave empty to keep the current image.
                @endif
            </small>
        </div>

        <div class="col-12">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('gallery') }}" class="btn btn-light">
                    Cancel
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i>
                    {{ $isEdit ? 'Update Activity' : 'Create Activity' }}
                </button>
            </div>
        </div>

    </div>
</form>
