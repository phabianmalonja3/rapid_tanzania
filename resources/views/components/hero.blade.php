<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    :root {
        --primary-color: #0088cc;
        --slide-time: 7000ms;
        --text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        --default-font: "Poppins", sans-serif;
        --heading-font: "Poppins", sans-serif;
    }

    /* =====================================================
       HERO SLIDER
    ===================================================== */
    .hero-slider {
        position: relative;
        width: 100%;
        height: 100vh;
        min-height: 650px;
        overflow: hidden;
        background: #000;
        font-family: var(--default-font);
    }

    /* =====================================================
       SLIDES CONTAINER
    ===================================================== */
    .hero-slider .slides {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
    }

    /* =====================================================
       SINGLE SLIDE
    ===================================================== */
    .hero-slider .slide {
        position: absolute;
        inset: 0;

        width: 100%;
        height: 100%;

        opacity: 0;
        visibility: hidden;

        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;

        transition:
            opacity 1.3s ease-in-out,
            visibility 1.3s ease-in-out;

        display: flex;
        align-items: center;
    }

    /* ACTIVE SLIDE */
    .hero-slider .slide.active {
        opacity: 1;
        visibility: visible;

        animation: kenBurns 20s ease-in-out infinite alternate;
    }

    /* =====================================================
       KEN BURNS EFFECT
    ===================================================== */
    @keyframes kenBurns {
        0% {
            transform: scale(1);
        }

        100% {
            transform: scale(1.08);
        }
    }

    /* =====================================================
       OVERLAY
    ===================================================== */
    .hero-slider .overlay {
        position: absolute;
        inset: 0;

        width: 100%;
        height: 100%;

        z-index: 1;

        background:
            linear-gradient(
                to right,
                rgba(0, 0, 0, 0.55) 0%,
                rgba(0, 0, 0, 0.35) 40%,
                rgba(0, 0, 0, 0.15) 70%,
                rgba(0, 0, 0, 0.05) 100%
            );
    }

    /* =====================================================
       BOTTOM CONTENT
       MAANDISHI YOTE YAKO CHINI
    ===================================================== */
    .hero-slider .content-wrapper {
        position: absolute;

        left: 0;
        bottom: 80px;

        width: 100%;

        padding-left: 8%;
        padding-right: 8%;

        z-index: 3;
    }

    /* =====================================================
       TITLE
    ===================================================== */
    .hero-slider h2 {
        font-family: var(--heading-font);

        font-size: clamp(2rem, 5vw, 4.2rem);

        font-weight: 700;

        color: #ffffff !important;

        line-height: 1.1;

        max-width: 850px;

        margin: 0 0 20px 0;

        text-shadow: var(--text-shadow);

        opacity: 0;

        transform: translateY(30px);
    }

    /* =====================================================
       DESCRIPTION
    ===================================================== */
    .hero-slider p {
        font-family: var(--default-font);

        font-size: 1.05rem;

        font-weight: 400;

        color: #ffffff !important;

        line-height: 1.6;

        max-width: 650px;

        margin: 0 0 25px 0;

        text-shadow: var(--text-shadow);

        opacity: 0;

        transform: translateY(30px);
    }

    /* =====================================================
       READ MORE BUTTON
    ===================================================== */
    .read-more-btn {
        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 8px;

        padding: 10px 20px;

        background-color: var(--primary-color);

        color: #ffffff !important;

        text-decoration: none !important;

        border-radius: 6px;

        font-family: var(--default-font);

        font-weight: 600;

        font-size: 14px;

        line-height: 1;

        border: none;

        cursor: pointer;

        transition:
            background-color 0.25s ease,
            transform 0.2s ease,
            box-shadow 0.25s ease;

        opacity: 0;

        transform: translateY(30px);
    }

    /* BUTTON HOVER */
    .read-more-btn:hover {
        background-color: #0077b3;

        color: #ffffff !important;

        transform: translateY(-2px);

        box-shadow:
            0 6px 18px rgba(0, 136, 204, 0.35);
    }

    /* BUTTON ICON */
    .read-more-btn i {
        font-size: 15px;

        transition:
            transform 0.25s ease;
    }

    .read-more-btn:hover i {
        transform: translateX(4px);
    }

    /* =====================================================
       CONTENT ANIMATION
    ===================================================== */

    .hero-slider .slide.active h2 {
        animation:
            floatUp 0.8s ease forwards 0.3s;
    }

    .hero-slider .slide.active p {
        animation:
            floatUp 0.8s ease forwards 0.5s;
    }

    .hero-slider .slide.active .read-more-btn {
        animation:
            floatUp 0.8s ease forwards 0.7s;
    }

    @keyframes floatUp {
        from {
            opacity: 0;

            transform:
                translateY(30px);
        }

        to {
            opacity: 1;

            transform:
                translateY(0);
        }
    }

    /* =====================================================
       SLIDER INDICATORS
    ===================================================== */
    .slider-indicators {
        position: absolute;

        right: 40px;

        top: 50%;

        transform: translateY(-50%);

        z-index: 10;

        display: flex;

        flex-direction: column;

        align-items: center;

        gap: 25px;

        padding: 20px 10px;
    }

    /* =====================================================
       INDICATOR ITEM
    ===================================================== */
    .indicator-item {
        position: relative;

        width: 18px;

        height: 18px;

        display: flex;

        align-items: center;

        justify-content: center;

        cursor: pointer;
    }

    /* =====================================================
       INDICATOR DOT
    ===================================================== */
    .indicator-dot {
        width: 8px;

        height: 8px;

        background:
            rgba(255, 255, 255, 0.45);

        border-radius: 50%;

        transition:
            all 0.4s ease;
    }

    /* ACTIVE DOT */
    .indicator-item.active .indicator-dot {
        background:
            var(--primary-color);

        transform:
            scale(1.4);

        box-shadow:
            0 0 10px rgba(0, 136, 204, 0.6);
    }

    /* =====================================================
       INDICATOR RING
    ===================================================== */
    .indicator-ring {
        position: absolute;

        top: -6px;

        left: -6px;

        width: 30px;

        height: 30px;

        transform:
            rotate(-90deg);

        opacity: 0;

        overflow: visible;
    }

    /* ACTIVE RING */
    .indicator-item.active .indicator-ring {
        opacity: 1;
    }

    .indicator-ring circle {
        fill: none;

        stroke:
            var(--primary-color);

        stroke-width: 2.5;

        stroke-linecap: round;

        stroke-dasharray: 88;

        stroke-dashoffset: 88;
    }

    /* RING PROGRESS */
    .indicator-item.active .indicator-ring circle {
        animation:
            ringProgress var(--slide-time) linear forwards;
    }

    @keyframes ringProgress {
        from {
            stroke-dashoffset: 88;
        }

        to {
            stroke-dashoffset: 0;
        }
    }

    /* =====================================================
       TABLET
    ===================================================== */
    @media (max-width: 992px) {

        .hero-slider {
            min-height: 600px;
        }

        .hero-slider .content-wrapper {
            bottom: 70px;

            padding-left: 6%;
            padding-right: 6%;
        }

        .hero-slider h2 {
            max-width: 750px;
        }

        .hero-slider p {
            max-width: 600px;
        }

        .slider-indicators {
            right: 25px;
        }
    }

    /* =====================================================
       MOBILE
    ===================================================== */
    @media (max-width: 768px) {

        .hero-slider {
            height: 100vh;

            min-height: 600px;
        }

        /* CONTENT CHINI */
        .hero-slider .content-wrapper {
            left: 0;

            bottom: 50px;

            width: 100%;

            padding-left: 5%;
            padding-right: 12%;
        }

        /* TITLE */
        .hero-slider h2 {
            font-size: 2rem;

            line-height: 1.15;

            max-width: 90%;

            margin-bottom: 15px;
        }

        /* DESCRIPTION */
        .hero-slider p {
            font-size: 0.95rem;

            line-height: 1.5;

            max-width: 90%;

            margin-bottom: 20px;
        }

        /* BUTTON */
        .read-more-btn {
            padding: 10px 18px;

            font-size: 13px;
        }

        /* INDICATORS */
        .slider-indicators {
            right: 12px;

            gap: 20px;
        }
    }

    /* =====================================================
       SMALL MOBILE
    ===================================================== */
    @media (max-width: 480px) {

        .hero-slider {
            min-height: 550px;
        }

        .hero-slider .content-wrapper {
            bottom: 35px;

            padding-left: 5%;

            padding-right: 14%;
        }

        .hero-slider h2 {
            font-size: 1.65rem;

            line-height: 1.2;

            margin-bottom: 12px;
        }

        .hero-slider p {
            font-size: 0.88rem;

            line-height: 1.45;

            margin-bottom: 18px;

            max-width: 88%;
        }

        .read-more-btn {
            padding: 9px 16px;

            font-size: 12px;
        }

        .slider-indicators {
            right: 7px;

            gap: 17px;
        }

        .indicator-item {
            width: 16px;

            height: 16px;
        }

        .indicator-dot {
            width: 7px;

            height: 7px;
        }

        .indicator-ring {
            width: 28px;

            height: 28px;

            top: -6px;

            left: -6px;
        }
    }
</style>


<!-- =====================================================
     HERO SLIDER
===================================================== -->

<section class="hero-slider">

    <!-- =================================================
         SLIDES
    ================================================== -->

    <div class="slides">

        <?php

            use App\Models\Post;
            use Illuminate\Support\Str;

            /*
             * Get latest 10 posts
             */
            $posts = Post::latest()
                ->take(10)
                ->get();

        ?>


        @foreach ($posts as $index => $post)

            <div
                class="slide @if($loop->first) active @endif"

                style="
                    background-image:
                    url('{{ asset('storage/' . $post->image) }}');
                "
            >

                <!-- =====================================
                     DARK OVERLAY
                ====================================== -->

                <div class="overlay"></div>


                <!-- =====================================
                     CONTENT
                     ITAKAA CHINI
                ====================================== -->

                <div class="content-wrapper">


                    <!-- =================================
                         POST TITLE
                    ================================== -->

                    <h3 class="text-white">
                        {{ $post->title }}
                    </h3>


                    <!-- =================================
                         POST DESCRIPTION
                    ================================== -->

                    <p>
                        {{ Str::limit(
                            strip_tags($post->content),
                            160,
                            '...'
                        ) }}
                    </p>


                    <!-- =================================
                         READ MORE
                    ================================== -->

                    <a
                        href="{{ route(
                            'event-view',
                            $post->slug ?? '#'
                        ) }}"

                        class="read-more-btn"
                    >

                        Read More

                        <i class="bi bi-arrow-right"></i>

                    </a>


                </div>

            </div>

        @endforeach

    </div>


    <!-- =================================================
         SLIDER INDICATORS
    ================================================== -->

    <div class="slider-indicators">

        @foreach ($posts as $index => $post)

            <div
                class="
                    indicator-item
                    @if($loop->first) active @endif
                "

                data-index="{{ $index }}"
            >

                <!-- RING -->

                <svg
                    class="indicator-ring"
                    viewBox="0 0 30 30"
                >

                    <circle
                        cx="15"
                        cy="15"
                        r="14"
                    ></circle>

                </svg>


                <!-- DOT -->

                <div class="indicator-dot"></div>

            </div>

        @endforeach

    </div>

</section>


<!-- =====================================================
     JAVASCRIPT
===================================================== -->

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        /* =============================================
           GET SLIDES
        ============================================== */

        const slides =
            document.querySelectorAll(
                '.hero-slider .slide'
            );


        /* =============================================
           GET INDICATORS
        ============================================== */

        const indicators =
            document.querySelectorAll(
                '.hero-slider .indicator-item'
            );


        /* =============================================
           SLIDE TIME
        ============================================== */

        const slideTime = 7000;


        /* =============================================
           CURRENT SLIDE
        ============================================== */

        let currentIndex = 0;


        /* =============================================
           CHECK IF SLIDES EXIST
        ============================================== */

        if (!slides.length) {
            return;
        }


        /* =============================================
           GO TO SLIDE
        ============================================== */

        function goToSlide(index) {

            /* -----------------------------------------
               Remove active from slides
            ------------------------------------------ */

            slides.forEach(
                function (slide) {

                    slide.classList.remove(
                        'active'
                    );

                }
            );


            /* -----------------------------------------
               Remove active from indicators
            ------------------------------------------ */

            indicators.forEach(
                function (indicator) {

                    indicator.classList.remove(
                        'active'
                    );


                    /* -------------------------------
                       Reset ring animation
                    -------------------------------- */

                    const ring =
                        indicator.querySelector(
                            'circle'
                        );


                    if (ring) {

                        ring.style.animation =
                            'none';

                        /*
                         * Force browser reflow
                         * so animation can restart
                         */

                        void ring.offsetWidth;

                        ring.style.animation =
                            null;
                    }

                }
            );


            /* -----------------------------------------
               Activate slide
            ------------------------------------------ */

            if (slides[index]) {

                slides[index].classList.add(
                    'active'
                );

            }


            /* -----------------------------------------
               Activate indicator
            ------------------------------------------ */

            if (indicators[index]) {

                indicators[index].classList.add(
                    'active'
                );

            }


            /* -----------------------------------------
               Update current index
            ------------------------------------------ */

            currentIndex = index;

        }


        /* =============================================
           NEXT SLIDE
        ============================================== */

        function nextSlide() {

            const nextIndex =
                (currentIndex + 1)
                % slides.length;


            goToSlide(nextIndex);

        }


        /* =============================================
           INDICATOR CLICK
        ============================================== */

        indicators.forEach(
            function (indicator, index) {

                indicator.addEventListener(
                    'click',
                    function () {

                        goToSlide(index);

                        resetTimer();

                    }
                );

            }
        );


        /* =============================================
           AUTO PLAY
        ============================================== */

        let autoPlay =
            setInterval(
                nextSlide,
                slideTime
            );


        /* =============================================
           RESET TIMER
        ============================================== */

        function resetTimer() {

            clearInterval(autoPlay);


            autoPlay =
                setInterval(
                    nextSlide,
                    slideTime
                );

        }


        /* =============================================
           START FIRST SLIDE
        ============================================== */

        goToSlide(0);

    }

);

</script>
