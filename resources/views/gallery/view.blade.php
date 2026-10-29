
@extends('layouts.main')

@section('main')
    <main class="main">

        <section class="page-title">
            <div class="container">
                <h1>Our Gallery</h1>
                <p>
                    Discover our work in disaster risk reduction,
                    humanitarian response, and community resilience.
                </p>
            </div>
        </section>

        <section class="gallery-section section">
            <div class="container">

                {{-- Success message --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                {{-- Validation or error messages --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row g-4">

                    @forelse ($galleries as $gallery)
                        <div class="col-lg-4 col-md-6">
                            <x-gallery-card
                                :image="$gallery->image
                                    ? asset('storage/' . $gallery->image)
                                    : asset('images/gallery/default.jpg')"
                                :title="$gallery->title"
                                :description="\Illuminate\Support\Str::limit(
                                    strip_tags($gallery->description),
                                    100
                                )"
                                :url="route('gallery.show', $gallery->id)"
                            />
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <h4>No Gallery Activities Yet</h4>
                            <p class="text-muted">
                                Gallery activities will appear here once they are published.
                            </p>
                        </div>
                    @endforelse

                </div>

                {{-- Pagination --}}
                @if ($galleries->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $galleries->links() }}
                    </div>
                @endif

            </div>
        </section>

    </main>
@endsection
