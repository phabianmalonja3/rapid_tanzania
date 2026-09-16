@extends("layouts.main")

@section('main')

<main class="main">

  <x-banner-card  :title="$project->title" current="Project Detail" />
    <!-- Service Details Section -->
    <section id="service-details" class="service-details section">

      <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-4 order-lg-2">
            <div class="service-sidebar aos-init aos-animate" data-aos="fade-left" data-aos-delay="200">

              <div class="service-overview-card">
                <div class="service-icon">
                  <i class="bi bi-building"></i>
                </div>
                <h3>{{$project->category->name}}</h3>
                <p></p>
                <div class="service-stats">
                  
                </div>
              </div>

              <div class="quick-info-card">
                <h4>Project Information</h4>
                <div class="info-grid">
                  
                  <div class="info-row">
                    <span class="label">Programme:</span>
                   
                    <span class="value">{{ $project->category->name ?? "" }}</span>
                  </div>
                
                 
                </div>
              </div>

             

            </div><!-- End Service Sidebar -->
          </div>

          <div class="col-lg-8 order-lg-1">
            <div class="service-main-content">

              <div class="hero-section aos-init aos-animate" data-aos="zoom-in" data-aos-delay="150">
                <img src="{{ asset('storage/'.$project->images[0]) }}" alt="Commercial Construction Services" class="img-fluid">
                <div class="hero-overlay">
                  <div class="hero-badge">
                    <i class="bi bi-award"></i>
                    {{-- <span>Licensed &amp; Insured</span> --}}
                  </div>
                </div>
              </div>

              {!! $project->content !!}

             
            </div><!-- End Service Main Content -->
          </div>
        </div>

        <div class="portfolio-showcase mt-5 aos-init aos-animate" data-aos="fade-up" data-aos-delay="350">
          <div class="showcase-header text-center">
            <h2>Recent Images Of Projects</h2>
            {{-- <p>Explore our portfolio of successfully completed commercial construction projects</p> --}}
          </div>


          <div class="row g-4 mt-3">
            <div class="col-lg-6">
              <div class="project-showcase-item">
                <div class="project-image">
                  <img src="{{ asset('storage/'.$project->images[0]) }}" alt="Office Building Construction" class="img-fluid">
                  <div class="project-overlay">
                    <div class="project-info">
                      
                      <a href="{{ asset('storage/'.$project->images[0]) }}" class="view-btn glightbox">
                        <i class="bi bi-eye"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="row g-3">



      @foreach ($images as $image)
    <div class="col-12">
                  <div class="project-showcase-item">
                    <div class="project-image">
                      <img src="{{ asset('storage/'.$image) }}" alt="Retail Space Construction" class="img-fluid" height="300">
                      <div class="project-overlay">
                        <div class="project-info">
                          
                          <a href="{{ asset('storage/'.$image) }}" class="view-btn glightbox">
                            <i class="bi bi-eye"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

    
@endforeach



              </div>
            </div>
          </div>
        </div><!-- End Portfolio Showcase -->

      </div>

    </section><!-- /Service Details Section -->

  </main>
@endsection