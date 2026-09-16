@extends("layouts.main")

@section('main')
<style>
    /* Styling for About Page Components */
    .about-card {
        border-radius: 20px;
        transition: transform 0.3s ease;
        background: #fff;
    }

    .expertise-item {
        padding: 20px;
        border-radius: 15px;
        background: #f8fafc;
        border: 1px solid #eef2f6;
        height: 100%;
        transition: all 0.3s ease;
    }

    .expertise-item:hover {
        background: #fff;
        border-color: #0088cc;
        box-shadow: 0 10px 25px rgba(0, 136, 204, 0.08);
        transform: translateY(-5px);
    }

    .icon-box-small {
        width: 45px;
        height: 45px;
        background: rgba(0, 136, 204, 0.1);
        color: #0088cc;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
    }

    .section-header-custom {
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 30px;
    }

    .section-header-custom::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: #0088cc;
    }

    .partnership-tag {
        display: inline-block;
        padding: 8px 16px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 50px;
        margin: 5px;
        font-size: 0.85rem;
        font-weight: 500;
        color: #475569;
    }
</style>

<main class="main">
    <x-banner-card title="About RAPID Tanzania" current="About" />

    <section class="py-5 bg-white">
        <div class="container" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section-header-custom">
                        <h6 class="text-primary text-uppercase fw-bold mb-2">Our Identity</h6>
                        <h2 class="fw-bold display-6">Background on RAPID Tanzania</h2>
                    </div>
                    <p class="lead text-muted mb-4">
                        <strong>RAPID-Tanzania</strong> is a registered NGO (Act No. 24 of 2002) committed to impactful disaster management and Disaster Risk Reduction (DRR) activities across the United Republic of Tanzania.
                    </p>
                    <p class="text-secondary">
                        Our wealth of experience ensures effective management and implementation of activities that build community resilience and safeguard the future of Tanzanian citizens.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 bg-light rounded-4 border">
                        <h5 class="fw-bold mb-3"><i class="bi bi-shield-check text-primary me-2"></i>Operational Mandate</h5>
                        <p class="small text-muted">We serve as the member and secretariat for the <strong>Disaster Management NGO Network (DINGONET)</strong>, bridging the gap between international standards and local action.</p>
                        <div class="d-flex flex-wrap mt-3">
                            <span class="partnership-tag shadow-sm">UNDAC Team Member</span>
                            <span class="partnership-tag shadow-sm">DarMAERT Partner</span>
                            <span class="partnership-tag shadow-sm">National Health Response</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold">Our Diverse Expertise</h2>
                <p class="text-muted">A multi-disciplinary approach to safety and resilience</p>
            </div>

            <div class="row g-4">
                @php
                    $expertises = [
                        ['icon' => 'bi-moisture', 'title' => 'Disaster Risk Management', 'desc' => 'Humanitarian response and vulnerability mapping.'],
                        ['icon' => 'bi-cloud-sun', 'title' => 'Environment & Climate', 'desc' => 'Climate change adaptation and environmental health.'],
                        ['icon' => 'bi-egg-fried', 'title' => 'Food Security', 'desc' => 'Urban food systems and nutrition studies.'],
                        ['icon' => 'bi-building', 'title' => 'Urban Planning', 'desc' => 'Engineering and architectural safety for rural/urban areas.'],
                        ['icon' => 'bi-balance-scale', 'title' => 'Policy & Law', 'desc' => 'Reviewing national action plans and economic frameworks.'],
                        ['icon' => 'bi-people', 'title' => 'Community Development', 'desc' => 'Social work and grassroots resilience building.']
                    ];
                @endphp

                @foreach($expertises as $item)
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="expertise-item shadow-sm">
                        <div class="icon-box-small">
                            <i class="{{ $item['icon'] }} fs-5"></i>
                        </div>
                        <h5 class="fw-bold">{{ $item['title'] }}</h5>
                        <p class="small text-muted mb-0">{{ $item['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5" data-aos="fade-right">
                    <img src="{{ asset("img/bg.jpg") }}" class="img-fluid rounded-4 shadow-lg" alt="Team Work">
                </div>
                <div class="col-lg-7" data-aos="fade-left">
                    <h3 class="fw-bold mb-4">Strategic Initiatives</h3>
                    <div class="accordion accordion-flush shadow-sm border rounded-4" id="initiativeAccordion">
                        <div class="accordion-item rounded-4 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    Planning & Preparedness
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#initiativeAccordion">
                                <div class="accordion-body text-muted">
                                    Development of Disaster Contingency Plans and the National Emergency Preparedness & Response Plan (EPRP).
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    Assessment & Mapping
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#initiativeAccordion">
                                <div class="accordion-body text-muted">
                                    Disaster Vulnerability assessment and mapping across high-risk zones in Tanzania.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    Partnership & Research
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#initiativeAccordion">
                                <div class="accordion-body text-muted">
                                    Collaborative studies on Urban Food Systems and Climate Change with academic and government institutions.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 p-3 border-start border-primary border-4 bg-light">
                        <p class="mb-0 fst-italic">"We maintain close operational ties with academic institutions and government departments to ensure science-backed disaster management."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-primary text-white text-center">
        <div class="container" data-aos="zoom-in">
            <h2 class="fw-bold">Ready to Support Our Mission?</h2>
            <p class="mb-4 opacity-75">Join RAPID Tanzania in building a more resilient nation.</p>
            <a href="{{ route('donate') }}" class="btn btn-light rounded-pill px-5 py-2 fw-bold text-primary">Get Involved</a>
        </div>
    </section>
</main>
@endsection