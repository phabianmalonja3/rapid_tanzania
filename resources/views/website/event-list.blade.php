@props(['events'])
@extends("layouts.main")

@section('main')
<style>
    /* 1. Dynamic Header with Overlay */
    .events-header {
        position: relative;
        background: linear-gradient(45deg, #0088cc, #005580);
        padding: 60px 0; /* Balanced padding */
        color: white;
        overflow: hidden;
    }

    .events-header::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 86c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm66-3c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-40-39c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.4;
    }

    /* 2. Premium Card Styling */
    .event-card {
        border: none;
        border-radius: 20px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        background: #fff;
        position: relative;
    }

    .event-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 22px 45px rgba(0, 0, 0, 0.08) !important;
    }

    .img-container {
        position: relative;
        overflow: hidden;
        border-radius: 20px 20px 0 0;
    }

    .img-container img {
        transition: transform 0.8s ease;
    }

    .event-card:hover .img-container img {
        transform: scale(1.1);
    }

    .date-badge {
        position: absolute;
        bottom: 15px;
        left: 15px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(5px);
        padding: 8px 15px;
        border-radius: 12px;
        font-weight: 800;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        z-index: 2;
    }

    .date-badge .day { color: #0088cc; font-size: 1.2rem; display: block; line-height: 1; }
    .date-badge .month { font-size: 0.7rem; text-uppercase; color: #333; }

    .event-title-link {
        color: #2d3436;
        transition: all 0.3s ease;
        text-decoration: none;
        background-image: linear-gradient(#0088cc, #0088cc);
        background-position: 0% 100%;
        background-repeat: no-repeat;
        background-size: 0% 2px;
    }

    .event-card:hover .event-title-link {
        color: #0088cc !important;
        background-size: 100% 2px;
    }

    .btn-read-more {
        background: #f8f9fa;
        color: #0088cc;
        border-radius: 10px;
        transition: all 0.3s ease;
        font-size: 0.85rem;
    }

    .event-card:hover .btn-read-more {
        background: #0088cc;
        color: #fff;
    }
</style>

<main class="main">
    

    <header class="events-header text-center">
        <div class="container position-relative" data-aos="fade-down">
            <span class="badge rounded-pill px-3 py-2 mb-3" style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3);">
                COMMUNITY IMPACT
            </span>
            <h2 class="display-5 fw-bold text-white mb-2">Our Latest News & Events</h2>
            <p class="opacity-75 mx-auto" style="max-width: 600px;">Stay updated with our humanitarian efforts and upcoming community programs.</p>
        </div>
    </header>

    <section id="latest-events" class="py-5" style="background-color: #f4f7f9;">
        <div class="container">
            
            @if($events && $events->count() > 0)
                <div class="row g-4 justify-content-center">
                    @foreach($events as $event)
                        @php
                            $images = $event->images ?? [];
                            $image = isset($images[0]) ? asset('storage/'.$images[0]) : asset('img/default.jpg');
                        @endphp
                        
                        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="card h-100 event-card shadow-sm">
                                
                                <div class="img-container">
                                    <img src="{{ $image }}" class="card-img-top" style="height: 250px; object-fit: cover;" alt="{{ $event->name }}">
                                    
                                    <div class="date-badge">
                                        <span class="day">{{ $event->start_at->format('d') }}</span>
                                        <span class="month">{{ $event->start_at->format('M') }}</span>
                                    </div>
                                </div>

                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3 small text-muted">
                                        <span class="badge bg-soft-primary text-primary me-2" style="background: #eef7ff;">
                                            <i class="bi bi-clock me-1"></i> {{ $event->start_at->format('h:i A') }}
                                        </span>
                                        <span class="text-truncate">
                                            <i class="bi bi-geo-alt me-1 text-danger"></i> {{ $event->location ?? 'Tanzania' }}
                                        </span>
                                    </div>

                                    <h5 class="fw-bold mb-3">
                                        <a href="{{ route('event-view', $event->slug) }}" class="event-title-link">
                                            {{ \Illuminate\Support\Str::limit($event->name, 55) }}
                                        </a>
                                    </h5>

                                    <p class="text-muted small mb-4 lh-base">
                                        {{ \Illuminate\Support\Str::limit($event->description, 110) }}
                                    </p>

                                    <a href="{{ route('event-view', $event->slug) }}" class="btn btn-read-more w-100 fw-bold py-2">
                                        VIEW DETAILS <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 d-flex justify-content-center">
                    {{ $events->links('pagination::bootstrap-5') }}
                </div>

            @else
                <div class="text-center py-5" data-aos="fade-up">
                    <div class="bg-white d-inline-block p-5 rounded-circle shadow-sm mb-4">
                        <i class="bi bi-calendar-x display-4 text-muted"></i>
                    </div>
                    <h3 class="fw-bold">No Events Posted Yet</h3>
                    <p class="text-muted">We're busy planning our next mission. Check back soon!</p>
                    <a href="/" class="btn btn-primary rounded-pill px-5 py-3 shadow">Return to Home</a>
                </div>
            @endif

        </div>
    </section>
</main>
@endsection