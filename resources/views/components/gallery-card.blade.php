
@props([
    'image',
    'title',
    'description',
    'url' => '#',
])

<div class="gallery-card">
    <img
        src="{{ $image }}"
        alt="{{ $title }}"
        class="gallery-image"
        loading="lazy"
    >

    <div class="gallery-overlay">
        <div class="gallery-content">
            <h3>{{ $title }}</h3>
            <p>{{ $description }}</p>

            <a href="{{ $url }}" class="gallery-button">
                View Full Details
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="gallery-caption">
        <h4>{{ $title }}</h4>
        <p>{{ $description }}</p>
    </div>
</div>
