 @extends('layouts.main')

@section('main')
<main class="main">

  
    <section class="section py-5">

        <div class="container">

        

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h2 class="mb-1">Gallery Management</h2>
                    <p class="text-muted mb-0">Manage gallery activities and images.</p>
                </div>

                <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>
                    Add Gallery Activity
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Activity Date</th>
                                    <th>Location</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($galleries as $gallery)
                                    <tr>
                                        <td>{{ $galleries->firstItem() + $loop->index }}</td>

                                        <td>
                                            @if ($gallery->image)
                                                <img
                                                    src="{{ asset('storage/' . $gallery->image) }}"
                                                    alt="{{ $gallery->title }}"
                                                    width="75"
                                                    height="55"
                                                    style="object-fit: cover; border-radius: 6px;"
                                                >
                                            @else
                                                <span class="text-muted">No image</span>
                                            @endif
                                        </td>

                                        <td class="fw-semibold">{{ $gallery->title }}</td>
                                        <td>{{ $gallery->category ?: '—' }}</td>
                                        <td>{{ $gallery->activity_date?->format('d M Y') ?? '—' }}</td>
                                        <td>{{ $gallery->location ?: '—' }}</td>

                                        <td>
                                            <div class="d-flex justify-content-end gap-2">
                                                <a
                                                    href="{{ route('admin.gallery.edit', $gallery->id) }}"
                                                    class="btn btn-sm btn-outline-primary"
                                                    title="Edit"
                                                >
                                                    <i class="bi bi-pencil-square"></i>
                                                    Edit
                                                </a>

                                                <form
                                                    action="{{ route('admin.gallery.destroy', $gallery->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this gallery activity?')"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <i class="bi bi-images fs-1 text-muted"></i>
                                            <h5 class="mt-3">No Gallery Activities Found</h5>
                                            <p class="text-muted">Start by adding your first gallery activity.</p>

                                            <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
                                                Add Gallery Activity
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $galleries->links() }}
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>
@endsection