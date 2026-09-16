<style>
    /* Section Background & Dynamic Elements */
    #programs {
        position: relative;
        background-color: #fcfdfe;
        overflow: hidden;
        padding: 100px 0; /* Increased breathing room */
    }

    .svg-bg-animation {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        z-index: 0;
        pointer-events: none;
        opacity: 0.5;
    }

    /* Modernized Program Card Styling */
    .program-box {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px 30px;
        height: 100%;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid rgba(226, 232, 240, 0.8);
        position: relative;
        z-index: 1;
    }

    .program-box:hover {
        transform: translateY(-12px);
        border-color: rgba(0, 136, 204, 0.3);
        box-shadow: 0 20px 40px rgba(0, 136, 204, 0.08) !important;
    }

    /* Program Numbering - Modernized */
    .program-number {
        font-size: 5rem;
        font-weight: 900;
        background: linear-gradient(180deg, rgba(0, 136, 204, 0.12) 0%, rgba(255, 255, 255, 0) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        position: absolute;
        top: -10px;
        right: 10px;
        pointer-events: none;
    }

    /* Icon Container */
    .icon-circle {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, rgba(0, 136, 204, 0.1) 0%, rgba(0, 136, 204, 0.05) 100%);
        color: #0088cc;
        border-radius: 16px; /* Modern squircle shape */
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        transition: 0.4s;
    }

    .program-box:hover .icon-circle {
        background: #0088cc;
        color: #fff;
        transform: rotate(-5deg) scale(1.1);
    }

    /* Typography & Buttons */
    .text-primary-custom { color: #0088cc !important; }
    
    .btn-main-custom {
        background-color: #0088cc;
        color: white;
        border-radius: 50px;
        padding: 14px 35px;
        font-weight: 600;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        transition: 0.3s;
        border: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-main-custom:hover {
        background-color: #0077b3;
        transform: translateX(5px);
        color: white;
    }

    /* SVG Animation */
    @keyframes float {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(15px, -25px); }
    }

    .animate-svg { animation: float 10s ease-in-out infinite; }
</style>

<section id="programs" class="section">
    <div class="svg-bg-animation">
        <svg width="100%" height="100%" viewBox="0 0 1440 800" xmlns="http://www.w3.org/2000/svg">
            <circle class="animate-svg" cx="5%" cy="15%" r="60" fill="#0088cc" opacity="0.04" />
            <circle class="animate-svg" cx="90%" cy="80%" r="100" fill="#0088cc" opacity="0.03" style="animation-delay: 2s;" />
        </svg>
    </div>

    <div class="container position-relative">
        <div class="row align-items-center g-5">

            <div class="col-lg-5" data-aos="fade-right">
                <div class="pe-lg-4">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-primary-custom-light text-primary-custom px-3 py-2 rounded-pill fw-bold text-uppercase small" style="background: rgba(0, 136, 204, 0.1);">
                           RAPID-Tanzania Since 2021
                        </span>
                    </div>
                    
                    <h2 class="display-5 fw-bold mb-4">Response and Preparedness in Disasters <span class="text-primary-custom">(RAPID-Tanzania)</span></h2>
                    
                    <p class="text-muted mb-4 fs-6" style="line-height: 1.8;">
  Response and Preparedness in Disasters (RAPID-Tanzania) is a Non-Governmental Organization registered in

              March 2021 under the NGOs Act, 2002 (Reg. No 00NGO/R/1785) and authorized to operate in Tanzania mainland.

              The organization deals with all disaster management activities encompassed in the disaster management

              cycle.
                    </p>

                    <div class="row g-3 mb-5">
                        <div class="col-6">
                            <h6 class="fw-bold mb-1"><i class="bi bi-check2-circle text-primary-custom me-2"></i> Registered</h6>
                            <p class="small text-muted">NGOs Act, 2002</p>
                        </div>
                        <div class="col-6">
                            <h6 class="fw-bold mb-1"><i class="bi bi-check2-circle text-primary-custom me-2"></i> Local Focus</h6>
                            <p class="small text-muted">Tanzania-wide</p>
                        </div>
                    </div>

                    <a href="{{ route('about') }}" class="btn btn-main-custom shadow-sm">
                        DISCOVER OUR STORY <i class="bi bi-arrow-right-short fs-4 ms-2"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="row g-4">
                    
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="program-box shadow-sm">
                            <span class="program-number">01</span>
                            <div class="icon-circle">
                                <i class="bi bi-people-fill fs-3"></i>
                            </div>
                            <h5 class="fw-bold">Community Resilience</h5>
                            <p class="small text-muted mb-0">Training and empowering local leaders to identify and mitigate risks before disasters strike.</p>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="program-box shadow-sm">
                            <span class="program-number">02</span>
                            <div class="icon-circle">
                                <i class="bi bi-lightning-charge-fill fs-3"></i>
                            </div>
                            <h5 class="fw-bold">Rapid Response</h5>
                            <p class="small text-muted mb-0">Deploying emergency teams and relief supplies instantly when crisis situations emerge.</p>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="program-box shadow-sm">
                            <span class="program-number">03</span>
                            <div class="icon-circle">
                                <i class="bi bi-heart-pulse-fill fs-3"></i>
                            </div>
                            <h5 class="fw-bold">Humanitarian Relief</h5>
                            <p class="small text-muted mb-0">Ensuring the most vulnerable populations have access to food, water, and medical care.</p>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="program-box shadow-sm">
                            <span class="program-number">04</span>
                            <div class="icon-circle">
                                <i class="bi bi-globe-americas fs-3"></i>
                            </div>
                            <h5 class="fw-bold">Climate Strategy</h5>
                            <p class="small text-muted mb-0">Implementing long-term environmental adaptations to protect against shifting climate patterns.</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>