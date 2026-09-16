
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    :root {
        --primary-color: #0088cc;
        --slide-time: 7000ms;
        --text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
         --default-font: "Poppins", sans-serif;
         --heading-font: "Poppins", sans-serif;
    }

   .hero-slider {
    position: relative;
    height: 100vh;
    min-height: 650px;
    overflow: hidden;
    background: #000;
    font-family: var(--default-font);
}

.hero-slider,
.hero-slider .tagline,
.hero-slider .tagline-text,
.hero-slider h1,
.hero-slider p,
.hero-slider .btn-main,
.hero-slider .btn-secondary-outline {
    font-family: var(--default-font);
}

.hero-slider h1 {
    font-family: var(--heading-font);
    font-size: clamp(2.5rem, 6vw, 4.2rem);
    color: #ffffff !important;
    line-height: 1.1;
    max-width: 850px;
    margin-bottom: 25px;
    text-shadow: var(--text-shadow);
    opacity: 0;
    transform: translateY(20px);
}

   .hero-slider .slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    visibility: hidden;
    transition: opacity 1.5s ease-in-out;
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    filter: none;
}

    .hero-slider .slide.active {
        opacity: 1;
        visibility: visible;
        animation: kenBurns 20s infinite alternate;
    }

    @keyframes kenBurns {
        0% { transform: scale(1); }
        100% { transform: scale(1.1); }
    }

    .hero-slider .overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to right,
        rgba(0, 0, 0, 0.25) 0%,
        rgba(0, 0, 0, 0.08) 45%,
        rgba(0, 0, 0, 0.00) 100%
    );
    z-index: 1;
}

    /* Content Layout */
    .hero-slider .content-wrapper {
        position: relative;
        z-index: 2;
        width: 100%;
        padding: 0 8%;
    }

    /* Double-Layered Tagline */
    .hero-slider .tagline {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
        border-left: 3px solid var(--primary-color);
        padding-left: 15px;
        opacity: 0;
        transform: translateY(20px);
    }

    .hero-slider .tagline-text {
        display: flex;
        flex-direction: column;
        line-height: 1.3;
    }

    .hero-slider .tagline-text .top-text {
        font-weight: 800;
        font-size: 0.85rem;
        letter-spacing: 2px;
        color: #ffffff !important;
    }

    .hero-slider .tagline-text .bottom-text {
        font-weight: 400;
        font-size: 1rem;
        color: #ffffff !important;
        opacity: 0.9;
    }

    /* Typography */
    .hero-slider h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.5rem, 6vw, 4.2rem);
        color: #ffffff !important;
        line-height: 1.1;
        max-width: 850px;
        margin-bottom: 25px;
        text-shadow: var(--text-shadow);
        opacity: 0;
        transform: translateY(20px);
    }

    .hero-slider p {
        font-size: 1.1rem;
        color: #ffffff !important;
        max-width: 600px;
        margin-bottom: 35px;
        line-height: 1.6;
        opacity: 0;
        transform: translateY(20px);
    }

    /* Compact Button Styling */
    .btn-hero-group {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        opacity: 0;
        transform: translateY(20px);
    }

    .btn-main {
        background: var(--primary-color);
        color: #ffffff !important;
        padding: 10px 24px; /* Smaller Padding */
        font-weight: 600;
        font-size: 0.9rem; /* Smaller Font */
        text-transform: uppercase;
        text-decoration: none;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 136, 204, 0.25);
        border-radius: 4px;
    }

    .btn-main:hover {
        background: #0077b3;
        transform: translateY(-2px);
    }

    .btn-secondary-outline {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
        color: #ffffff !important;
        padding: 10px 24px; /* Smaller Padding */
        font-weight: 600;
        font-size: 0.9rem; /* Smaller Font */
        text-transform: uppercase;
        text-decoration: none;
        border: 1.5px solid #ffffff; /* Thinner Border */
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        border-radius: 4px;
    }

    .btn-secondary-outline:hover {
        background: #ffffff;
        color: #000000 !important;
    }

    /* Staggered Content Animation */
    .slide.active .tagline { animation: floatUp 0.8s forwards 0.3s; }
    .slide.active h1 { animation: floatUp 0.8s forwards 0.5s; }
    .slide.active p { animation: floatUp 0.8s forwards 0.7s; }
    .slide.active .btn-hero-group { animation: floatUp 0.8s forwards 0.9s; }

    @keyframes floatUp {
        to { opacity: 1; transform: translateY(0); }
    }

    /* Sidebar Indicators */
    .slider-indicators {
        position: absolute;
        right: 40px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        display: flex;
        flex-direction: column;
        gap: 25px;
        padding: 25px 12px;
        border-radius: 40px;
      
    }

    .indicator-item {
        position: relative;
        width: 18px; height: 18px;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
    }

    .indicator-dot {
        width: 8px; height: 8px;
        background: rgba(255,255,255,0.4);
        border-radius: 50%;
        transition: 0.4s;
    }

    .indicator-item.active .indicator-dot {
        background: var(--primary-color);
        transform: scale(1.3);
    }

    .indicator-ring {
        position: absolute;
        top: -6px; left: -6px;
        width: 30px; height: 30px;
        transform: rotate(-90deg);
        opacity: 0;
    }

    .indicator-item.active .indicator-ring { opacity: 1; }

    .indicator-ring circle {
        fill: none;
        stroke: var(--primary-color);
        stroke-width: 2.5;
        stroke-dasharray: 88;
        stroke-dashoffset: 88;
    }

    .indicator-item.active .indicator-ring circle {
        animation: ringProgress var(--slide-time) linear forwards;
    }

    @keyframes ringProgress {
        from { stroke-dashoffset: 88; }
        to { stroke-dashoffset: 0; }
    }

    @media (max-width: 768px) {
        .btn-hero-group { flex-direction: column; align-items: flex-start; }
        .hero-slider .content-wrapper { padding: 0 5%; }
        .slider-indicators { right: 15px; }
        .btn-main, .btn-secondary-outline { width: fit-content; }
    }
</style>

<section class="hero-slider">
    <div class="slides">
        <?php 
            use App\Models\Post;
            use Illuminate\Support\Str;
            $posts = Post::latest()->take(5)->get();
        ?>

        @foreach ($posts as $index => $post)
            <div class="slide @if ($loop->first) active @endif" 
                 style="background-image: url({{ asset('storage/' . $post->image) }});">
                
                <div class="overlay"></div>

                <div class="content-wrapper">
                    <div class="tagline">
                        <i class="bi bi-heart-pulse-fill" style="color: var(--primary-color); font-size: 1.4rem;"></i>
                        <div class="tagline-text">
                            <span class="top-text">THE POWER OF HUMANITY</span>
                            <span class="bottom-text">Humanitarian Excellence</span>
                        </div>
                    </div>

                    <h1>{{ $post->title }}</h1>

                    <p>{{ Str::limit(strip_tags($post->content), 160, '...') }}</p>
                    <a href="{{ route('event-view', $post->slug ?? '#') }}" class="read-more-btn">
    Read More
    <i class="bi bi-arrow-right"></i>
</a>

                   
                </div>
            </div>
        @endforeach
    </div>

    <div class="slider-indicators">
        @foreach ($posts as $index => $post)
            <div class="indicator-item @if($loop->first) active @endif" data-index="{{ $index }}">
                <svg class="indicator-ring">
                    <circle cx="15" cy="15" r="14"></circle>
                </svg>
                <div class="indicator-dot"></div>
            </div>
        @endforeach
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.slide');
        const indicators = document.querySelectorAll('.indicator-item');
        let currentIndex = 0;
        const slideTime = 7000; 

        function goToSlide(index) {
            slides.forEach(s => s.classList.remove('active'));
            indicators.forEach(i => {
                i.classList.remove('active');
                const ring = i.querySelector('circle');
                ring.style.animation = 'none';
                void ring.offsetWidth; 
                ring.style.animation = null;
            });
            
            slides[index].classList.add('active');
            indicators[index].classList.add('active');
            currentIndex = index;
        }

        function nextSlide() {
            let next = (currentIndex + 1) % slides.length;
            goToSlide(next);
        }

        indicators.forEach((dot, idx) => {
            dot.addEventListener('click', () => {
                goToSlide(idx);
                resetTimer();
            });
        });

        let autoPlay = setInterval(nextSlide, slideTime);

        function resetTimer() {
            clearInterval(autoPlay);
            autoPlay = setInterval(nextSlide, slideTime);
        }
    });
</script>