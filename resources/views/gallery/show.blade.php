
@extends('layouts.main')

@section('main')
    <main class="main">

        {{-- Page Header --}}
        <section class="page-title">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('gallery') }}">Gallery</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Activity Details
                        </li>
                    </ol>
                </nav>

                <h1>{{ $gallery->title }}</h1>
                <p>Discover more about our work and community impact.</p>
            </div>
        </section>

        {{-- Activity Details --}}
        <section class="section gallery-details">
            <div class="container">
                <div class="row g-5">

                    {{-- Main Image and Description --}}
                    <div class="col-lg-8">
                        <div class="gallery-detail-image">
                            <img
                                src="{{ asset('storage/' . $gallery->image) }}"
                                alt="{{ $gallery->title }}"
                                class="img-fluid"
                            >
                        </div>

                        <div class="gallery-detail-content mt-4">
                            <span class="gallery-category">
                                {{ $gallery->category ?? 'Our Activities' }}
                            </span>

                            <h2>{{ $gallery->title }}</h2>

                            <div class="gallery-description">
                                {!! nl2br(e($gallery->description)) !!}
                            </div>
                        </div>
                    </div>

                    {{-- Activity Information --}}
                    <div class="col-lg-4">
                        <div class="gallery-info-card">
                            <h3>Activity Information</h3>

                            <div class="gallery-info-item">
                                <i class="bi bi-calendar-event"></i>
                                <div>
                                    <strong>Date</strong>
                                    <p>
                                        {{ $gallery->activity_date
                                            ? \Carbon\Carbon::parse($gallery->activity_date)->format('d M Y')
                                            : 'Date not provided' }}
                                    </p>
                                </div>
                            </div>

                            <div class="gallery-info-item">
                                <i class="bi bi-geo-alt"></i>
                                <div>
                                    <strong>Location</strong>
                                    <p>{{ $gallery->location ?? 'Location not provided' }}</p>
                                </div>
                            </div>

                            <hr>

                            <a href="{{ route('gallery') }}"
                               class="btn gallery-back-button">
                                <i class="bi bi-arrow-left"></i>
                                Back to Gallery
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
