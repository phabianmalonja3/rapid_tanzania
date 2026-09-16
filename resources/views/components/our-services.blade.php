<style>
    /* --- Who We Are Custom Animations --- */
    
    /* 1. Image Floating Effect */
    .about-image-wrapper img {
        transition: transform 0.5s ease, box-shadow 0.5s ease;
    }
    .about-image-wrapper:hover img {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 136, 204, 0.2) !important;
    }

    /* 2. Icon Circle Pulse & Rotate */
    .icon-box {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .mission-item:hover .icon-box {
        background-color: #0088cc !important;
        transform: rotate(10deg) scale(1.1);
    }
    .mission-item:hover .icon-box i {
        color: white !important;
    }

    /* 3. Text Highlight on Hover */
    .mission-item {
        transition: all 0.3s ease;
        padding: 10px;
        border-radius: 15px;
    }
    .mission-item:hover {
        background: rgba(0, 136, 204, 0.03);
    }
    .mission-item:hover h4 {
        color: #0088cc;
        transition: color 0.3s ease;
    }

    /* 4. Button Shine Effect */
    .btn-animate {
        position: relative;
        overflow: hidden;
    }
    .btn-animate::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: 0.5s;
    }
    .btn-animate:hover::after {
        left: 100%;
    }
</style>

<section id="who-we-are" class="py-5" style="background-color: #fdfdfd;">
    <div class="container" data-aos="fade-up">
        <div class="row g-5 align-items-center">
            
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                <div class="position-relative about-image-wrapper">
                    <img src="{{ asset('img/Picture7.png') }}" alt="RAPID-Tanzania Team" class="img-fluid rounded-4 shadow-lg">
                    
                    <div class="position-absolute bottom-0 start-0 p-3 rounded-3 d-none d-md-block" 
                         style="background-color: #0088cc; transform: translate(-15px, 15px); width: 100px; height: 100px; z-index: -1;">
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="ps-lg-4">
                    <h6 class="fw-bold mb-2" style="color: #0088cc; font-family: 'Cursive', sans-serif;">About RAPID-Tanzania</h6>
                    <h2 class="display-5 fw-bold mb-5">Who Are We</h2>

                    <div class="d-flex mb-4 mission-item" data-aos="fade-up" data-aos-delay="100">
                        <div class="flex-shrink-0">
                            <div class="bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center icon-box" 
                                 style="width: 70px; height: 70px; border: 2px solid #0088cc;">
                                <i class="bi bi-person-check-fill fs-3" style="color: #0088cc;"></i>
                            </div>
                        </div>
                        <div class="ms-4">
                            <h4 class="fw-bold mb-1">Our Mission</h4>
                            <p class="text-muted mb-0 small">“To empower vulnerable, marginalized, and displaced communities to achieve self-reliance and sustainable development and to reduce human suffering and poverty”</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4 mission-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="flex-shrink-0">
                            <div class="bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center icon-box" 
                                 style="width: 70px; height: 70px; border: 2px solid #0088cc;">
                                <i class="bi bi-eye-fill fs-3" style="color: #0088cc;"></i>
                            </div>
                        </div>
                        <div class="ms-4">
                            <h4 class="fw-bold mb-1">Our Vision</h4>
                            <p class="text-muted mb-0 small">"Empowered communities living in a just, democratic society, united in diversity and enjoying quality of life and God-given dignity."</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4 mission-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="flex-shrink-0">
                            <div class="bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center icon-box" 
                                 style="width: 70px; height: 70px; border: 2px solid #0088cc;">
                                <i class="bi bi-shield-check fs-3" style="color: #0088cc;"></i>
                            </div>
                        </div>
                        <div class="ms-4">
                            <h4 class="fw-bold mb-1">Our Core Values</h4>
                            <p class="text-muted mb-0 small">Universal Justice, Dignity, Self-reliance, Sustainable Livelihoods, Humanity, Transparency and Accountability.</p>
                        </div>
                    </div>

                    <div class="mt-5" data-aos="zoom-in" data-aos-delay="400">
                        <a href="{{ route('about') }}" class="btn btn-animate rounded-pill px-5 py-3 fw-bold text-white shadow transition-lift" 
                           style="background-color: #0088cc; border: none; letter-spacing: 1px;">
                           READ MORE <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>