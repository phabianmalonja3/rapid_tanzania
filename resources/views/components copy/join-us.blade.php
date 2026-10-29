<style>
    /* Partners Section Styling */
    #clients {
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
    }

    .client-logo-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100px; /* Uniform height for all logo slots */
        padding: 10px;
    }

    .client-logo {
        max-height: 60px; /* Smaller, professional size */
        width: auto;
        filter: grayscale(100%);
        opacity: 0.6;
        transition: all 0.4s ease;
    }

    .swiper-slide:hover .client-logo {
        filter: grayscale(0%);
        opacity: 1;
        transform: scale(1.05);
    }

    /* Grabbing cursor for UX */
    .clients-swiper {
        cursor: grab;
    }
    .clients-swiper:active {
        cursor: grabbing;
    }
</style>

<section id="clients" class="clients section py-5">
    <div class="container">
        <div class="section-title mb-5 text-center" data-aos="fade-up">
            <h2 style="color: #102a49; font-weight: 700;">Strategic Partners</h2>
            {{-- <div style="width: 50px; height: 3px; background: #0088cc; margin: 10px auto;"></div> --}}
        </div>

        <div class="swiper clients-swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper align-items-center">
                @php
                    use App\Models\OrgClient;
                    $clients = OrgClient::latest()->get();
                @endphp

                @foreach ($clients as $client)
                    <div class="swiper-slide">
                        <div class="client-logo-wrapper">
                            @if($client->website_url)
                                <a href="{{ $client->website_url }}" target="_blank">
                            @endif
                                <img src="{{ asset('storage/' . $client->profile) }}" 
                                     alt="{{ $client->name ?? 'Partner' }}" 
                                     class="img-fluid client-logo">
                            @if($client->website_url)
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="swiper-pagination mt-4"></div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.clients-swiper', {
            speed: 600,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            slidesPerView: 2,
            spaceBetween: 40,
            breakpoints: {
                320: { slidesPerView: 2, spaceBetween: 40 },
                480: { slidesPerView: 3, spaceBetween: 60 },
                640: { slidesPerView: 4, spaceBetween: 80 },
                992: { slidesPerView: 6, spaceBetween: 100 }
            },
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true,
            },
        });
    });
</script>