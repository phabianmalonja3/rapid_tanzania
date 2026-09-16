<style>
    /* --- Layout & Animation Styles --- */
    .transition-all { transition: all 0.3s ease-in-out; }
    .transition-zoom { transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1); }
    .transition-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }

    /* 1. Featured Card Hover: Image Zoom & Description Underline */
    .featured-event-card:hover .transition-zoom {
        transform: scale(1.05);
    }
    .featured-event-card:hover .event-description-link {
        color: #0088cc !important;
        text-decoration: underline !important;
    }

    /* 2. Side List Hover: Red Title & Underline (Matches TRCS Style) */
    .event-list-item {
        cursor: pointer;
    }
    .event-list-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1) !important;
    }
    /* When hovering the list box, target the title specifically */
    .event-list-item:hover .event-title-link {
        color: #0088cc !important; /* Red color */
        text-decoration: underline !important;
    }
    .event-list-item:hover .transition-zoom {
        transform: scale(1.1);
    }

    /* Global Title Hover fallback */
    .hover-primary:hover {
        color: #0088cc !important;
    }
</style>

<section id="latest-events" class="py-5" style="background-color: #f8f9fa;">
    <div class="container" data-aos="fade-up">
        
        <div class="section-title text-center mb-5">
            <h6 class="fw-bold text-uppercase mb-2" style="color: #0088cc; letter-spacing: 2px;">Updates</h6>
            <h2 class="display-5 fw-bold">Latest Events</h2>
            <div class="mx-auto" style="width: 50px; height: 3px; background-color: #0088cc;"></div>
        </div>

        @php
            use App\Models\Event;
            use Illuminate\Support\Str;
            // Get 4 latest events
            $events = Event::latest()->take(4)->get(); 
        @endphp

        @if($events->count() > 0)
            @php 
                $featured = $events->first(); 
                $others = $events->skip(1);
            @endphp

            <div class="row g-4 align-items-stretch">
                <div class="col-lg-7" data-aos="fade-right" data-aos-delay="100">
                    <div class="card h-100 shadow-sm rounded-4 border-0 overflow-hidden bg-white featured-event-card transition-all">
                        @php
                            $f_images = $featured->images ?? [];
                            $f_image = isset($f_images[0]) ? asset('storage/'.$f_images[0]) : asset('img/default.jpg');
                        @endphp
                        
                        <div class="position-relative overflow-hidden">
                            <img src="{{ $f_image }}" class="card-img-top transition-zoom" style="height: 420px; object-fit: cover;" alt="{{ $featured->name }}">
                            <div class="position-absolute top-0 start-0 text-white px-3 py-1 mt-3 ms-3 fw-bold small rounded-1 shadow-sm" style="background-color: #0088cc; z-index: 10;">
                                IMPORTANT ANNOUNCEMENT
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="mb-2 small fw-bold" style="color: #0088cc;">
                                <i class="bi bi-calendar3 me-1"></i> {{ $featured->start_at->format('F d, Y') }}
                            </div>
                            <h3 class="fw-bold mb-3">
                                <a href="{{ route('event-view', $featured->slug) }}" class="text-dark text-decoration-none text-uppercase hover-primary transition-all">
                                    {{ $featured->name }}
                                </a>
                            </h3>
                            <p class="mb-0">
                                <a href="{{ route('event-view', $featured->slug) }}" class="text-muted text-decoration-none event-description-link transition-all">
                                    {{ Str::limit($featured->description, 180) }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5" data-aos="fade-left" data-aos-delay="200">
                    <div class="d-flex flex-column gap-4 h-100">
                        @foreach ($others as $index => $event)
                            @php
                                $s_images = $event->images ?? [];
                                $s_image = isset($s_images[0]) ? asset('storage/'.$s_images[0]) : asset('img/default.jpg');
                            @endphp
                            
                            <div class="event-list-item row g-3 align-items-center bg-white p-2 rounded-4 shadow-sm border-0 transition-lift mx-0">
                                <div class="col-4 p-0">
                                    <div class="overflow-hidden rounded-3">
                                        <img src="{{ $s_image }}" class="img-fluid transition-zoom" style="height: 110px; width: 100%; object-fit: cover;" alt="{{ $event->name }}">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="small mb-1" style="color: #666;">
                                        <i class="bi bi-calendar-event me-1" style="color: #0088cc;"></i> {{ $event->start_at->format('F d, Y') }} 
                                    </div>
                                    <h6 class="fw-bold mb-0">
                                        <a href="{{ route('event-view', $event->slug) }}" class="event-title-link text-dark text-decoration-none text-uppercase lh-sm small transition-all">
                                            {{ Str::limit($event->name, 65) }}
                                        </a>
                                    </h6>
                                    <div class="text-muted mt-1" style="font-size: 0.75rem;">
                                        <i class="bi bi-clock me-1"></i> {{ $event->start_at->format('H:i A') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="mt-auto pt-3">
                            <a href="#" 
                               class="btn w-100 rounded-pill py-2 fw-bold transition-lift shadow-sm"
                               style="background-color: #0088cc; color: white; border: none; font-size: 0.85rem;">
                               VIEW ALL EVENTS <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-calendar-x display-4 text-muted"></i>
                <p class="text-muted mt-3">No recent events found.</p>
            </div>
        @endif
    </div>
</section>