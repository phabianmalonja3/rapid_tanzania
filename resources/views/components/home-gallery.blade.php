
@php
    use App\Models\Gallery;

    $homeGalleries = Gallery::whereNotNull('image')
        ->latest()
        ->take(6)
        ->get();
@endphp

<section class="home-gallery section">
    <div class="container">

        <div class="section-title text-center">
            <h2>Our Gallery</h2>
            <p>
                Explore our activities, community initiatives, and the
                impact we are making together across Tanzania.
            </p>
        </div>

        <div class="row g-4 mt-3">

            @forelse ($homeGalleries as $gallery)
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-card h-100">

                        {{-- Gallery Image --}}
                        <div class="gallery-card-image">
                            <img
                                src="{{ asset('storage/' . $gallery->image) }}"
                                alt="{{ $gallery->title }}"
                                loading="lazy"
                            >

                            {{-- Hover Overlay --}}
                            <div class="gallery-card-overlay">
                                <a
                                    href="{{ route('gallery.show', $gallery->id) }}"
                                    class="btn btn-light"
                                >
                                    View Full Details
                                    <i class="bi bi-arrow-up-right"></i>
                                </a>
                            </div>
                        </div>

                        {{-- Card Content --}}
                        <div class="gallery-card-content">
                            @if ($gallery->category)
                                <span class="gallery-category">
                                    {{ $gallery->category }}
                                </span>
                            @endif

                            <h4>
                                <a href="{{ route('gallery.show', $gallery->id) }}">
                                    {{ $gallery->title }}
                                </a>
                            </h4>

                            <p>
                                {{ \Illuminate\Support\Str::limit(
                                    strip_tags($gallery->description),
                                    100
                                ) }}
                            </p>

                            @if ($gallery->activity_date)
                                <small class="gallery-date">
                                    <i class="bi bi-calendar3"></i>
                                    {{ $gallery->activity_date->format('d M Y') }}
                                </small>
                            @endif
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-images fs-1 text-muted"></i>
                    <h4 class="mt-3">No Gallery Activities Yet</h4>
                    <p class="text-muted">
                        Our activities and community stories will appear here.
                    </p>
                </div>
            @endforelse

        </div>

        {{-- View Full Gallery --}}
        <div class="text-center mt-5">
            <a href="{{ route('gallery') }}"
               class="btn btn-primary gallery-view-all">
                View Full Gallery
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>

    </div>
</section>
