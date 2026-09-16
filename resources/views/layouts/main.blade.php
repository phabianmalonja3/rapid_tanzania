<!DOCTYPE html>
<html lang="en">

<head>
    {!! seo($seoData, null) !!}
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/favicon.ico" rel="icon">
    <link href="/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="stylesheet" id="givewp-campaign-blocks-fonts-css"
        href="https://fonts.googleapis.com/css2?family=Inter%3Awght%40400%3B500%3B600%3B700&amp;display=swap&amp;ver=6.8.3"
        type="text/css" media="all">
    <link rel="stylesheet" id="loveicon-google-fonts-css"
        href="https://fonts.googleapis.com/css?display=swap&amp;family=Great+Vibes:300,400,500,600,700,800,900%7CInter:300,400,500,600,700,800,900&amp;subset=latin,cyrillic-ext,latin-ext,cyrillic,greek-ext,greek,vietnamese"
        type="text/css" media="all">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/bundles/izitoast/css/iziToast.min.css')}}">
  <!-- Template CSS -->
    <style>
        .donate-btn {
            background: #ff4d4d;
            color: #fff !important;
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: 600;
        }

        .donate-btn:hover {
            background: #e63939;
        }



@media (max-width: 480px) {
    .donate-btn {
        margin-left: 5%;
        display: block;
        width: 50%;
        padding: 12px 0;   /* Larger tap area */
        font-size: 16px;   /* Bigger text */
        text-align: center;
    }
}
        .whatsapp-float {
            position: fixed;
            width: 55px;
            height: 55px;
            bottom: 90px;
            right: 20px;
            background-color: #25D366;
            color: #fff;
            border-radius: 50%;
            font-size: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            transition: 0.3s;
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
        }

        /* Scroll Top Button */
        .scroll-top {
            bottom: 20px;
            /* 🟢 Scroll-top stays lower */
            right: 20px;
            z-index: 9998;
        }

        #who-we-are .d-flex:hover .rounded-circle {
    background-color: #0088cc !important;
    transition: all 0.4s ease;
    transform: rotateY(10deg);
}

#who-we-are .d-flex:hover .rounded-circle i {
    color: white !important;
}

#who-we-are .btn:hover {
    background-color: #006699 !important; /* A slightly darker shade of your blue */
    transform: translateY(-2px);
}

.event-title-link {
    transition: color 0.3s ease;
}

/* Hover state: Triggered when the parent item is hovered */
.event-list-item:hover .event-title-link {
    color: #0088cc !important; /* Red color as seen in your screenshot */
    text-decoration: underline !important;
}

/* Optional: Smooth transition for the image zoom as well */
.event-list-item:hover .transition-zoom {
    transform: scale(1.1);
}

.scroll-top {
  position: fixed;
  bottom: 20px;
  right: 20px;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: #eee; /* Background of the button */
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  transition: opacity 0.3s;
  /* This variable will be updated by JS */
  --scroll-percent: 0%; 
}

.scroll-progress-wrapper {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  /* The border effect */
  background: conic-gradient(#0088cc var(--scroll-percent), transparent 0%);
  padding: 3px; /* This defines the border thickness */
}

.scroll-progress-wrapper i {
  background: white; /* Inner button color */
  width: 100%;
  height: 100%;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  color: #007bff;
}
    </style>



</head>

<body class="index-page">

    <header id="header" class="header sticky-top">

        <x-top-bar />
        <div class="branding d-flex align-items-cente">

            <div class="container position-relative d-flex align-items-center justify-content-between">
                <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                    
                    <img src="{{ asset('assets/img/logo1.png') }}" width="100" alt="">
                </a>

                <x-front-nav />

            </div>

        </div>

    </header>

    @yield('main')

    <x-footer />

    <a href="https://wa.me/255715022411?text=Hello%2C%20I%20visited%20the%20RAPID-Tanzania%20website%20and%20I%20would%20like%20to%20know%20more%20about%20your%20services."
        target="_blank" rel="noopener noreferrer"
        class="whatsapp-float d-flex align-items-center justify-content-center">
        <i class="bi bi-whatsapp"></i>
    </a>

   <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <span class="scroll-progress-wrapper">
        <i class="bi bi-arrow-up-short"></i>
    </span>
</a>
    <div id="preloader">
        <div class='preloader'>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
      <script src="{{asset('assets/bundles/izitoast/js/iziToast.min.js')}}"></script>

  <script src="{{asset('assets/js/page/toastr.js')}}"></script>

    <script src="{{ asset('js/main.js') }}"></script>


    <script>

    
        

        document.addEventListener("DOMContentLoaded", function() {

            window.onscroll = function() {
  const scrollTopButton = document.getElementById("scroll-top");
  
  // Calculate scroll percentage
  const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  const scrolled = (winScroll / height) * 100;

  // Update the CSS Variable
  scrollTopButton.style.setProperty('--scroll-percent', scrolled + '%');

  // Show/Hide button based on scroll position
  if (winScroll > 100) {
    scrollTopButton.style.opacity = "1";
  } else {
    scrollTopButton.style.opacity = "0";
  }
};

            /*** Slide Show for .slide elements ***/
            const slides = document.querySelectorAll(".slide");
            if (slides.length) {
                let index = 0;

                function showNextSlide() {
                    slides[index].classList.remove("active");
                    index = (index + 1) % slides.length;
                    slides[index].classList.add("active");
                }

                const nextBtn = document.querySelector(".next");
                const prevBtn = document.querySelector(".prev");
                if (nextBtn) nextBtn.addEventListener("click", showNextSlide);
                if (prevBtn) prevBtn.addEventListener("click", () => {
                    slides[index].classList.remove("active");
                    index = (index - 1 + slides.length) % slides.length;
                    slides[index].classList.add("active");
                });

                setInterval(showNextSlide, 7000); // Auto slide every 7s
            }

            /*** Clients Swiper ***/
            var swiper = new Swiper(".clients-swiper", {
                slidesPerView: 2, // 2 logos on small screens
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    // when window width is >= 768px (md)
                    768: {
                        slidesPerView: 4,
                    },
                    // when window width is >= 1024px (lg)
                    1024: {
                        slidesPerView: 5, // 5 logos on larger screens
                    }
                }
            });

            /*** Scroll-top button ***/
            const scrollTop = document.querySelector('.scroll-top');
            if (scrollTop) {
                const toggleScrollTop = () => {
                    window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove(
                        'active');
                };
                scrollTop.addEventListener('click', e => {
                    e.preventDefault();
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
                document.addEventListener('scroll', toggleScrollTop);
                toggleScrollTop();
            }

            /*** Preloader ***/
            const preloader = document.querySelector('#preloader');
            if (preloader) setTimeout(() => preloader.remove(), 300);


      const FORM_KEY = "donation_form_data";
const EXPIRY_KEY = "donation_form_expiry";

const form = document.getElementById("donationForm");
const submitBtn = document.querySelector(".btn-submit");

// Check if user already submitted
const savedData = localStorage.getItem(FORM_KEY);
const expiry = localStorage.getItem(EXPIRY_KEY);
const now = new Date().getTime();

// If exists and not expired → block
if (savedData && expiry && now < expiry) {
    blockForm(JSON.parse(savedData));
}

// If expired → clear
if (expiry && now >= expiry) {
    localStorage.removeItem(FORM_KEY);
    localStorage.removeItem(EXPIRY_KEY);
}

// Handle form submission
form.addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = {
        name: form.name.value,
        email: form.email.value,
        amount: form.amount.value,
        method: form.method.value,
        message: form.message.value,
    };

    // Disable button & show spinner
    submitBtn.disabled = true;
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...`;

    // SEND DATA TO LARAVEL API
    fetch("/website/donate", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(formData)
    })
    .then(res => res.json())
    .then(response => {
        if (response.status === "success") {

            // Save to localStorage for 24 hours
            const oneDay = 24 * 60 * 60 * 1000;
            localStorage.setItem(FORM_KEY, JSON.stringify(formData));
            localStorage.setItem(EXPIRY_KEY, new Date().getTime() + oneDay);

            blockForm(formData);

            iziToast.success({
                title: 'Success',
                message: 'Donation submitted successfully!',
                position: 'topRight'
            });
        } else {
            // Re-enable button if API returns error
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;

            iziToast.error({
                title: 'Error',
                message: response.message || 'Failed to send donation. Please try again.',
                position: 'topRight'
            });
        }
    })
    .catch(error => {
        console.error("Error:", error);

        // Re-enable button
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;

        iziToast.error({
            title: 'Error',
            message: 'Failed to send donation. Please try again.',
            position: 'topRight'
        });
    });
});

// Block form + show submitted info
function blockForm(data) {
    form.style.display = "none";

    const summaryBox = document.createElement("div");
    summaryBox.classList.add("alert", "alert-success", "p-3", "mt-3");

    summaryBox.innerHTML = `
        <h5>Donation Already Submitted Today</h5>
        <p><strong>Name:</strong> ${data.name}</p>
        <p><strong>Email:</strong> ${data.email}</p>
        <p><strong>Amount:</strong> ${data.amount} TZS</p>
        <p><strong>Method:</strong> ${data.method.replace("_", " ")}</p>
        <p><strong>Message:</strong> ${data.message || "No message"}</p>
        <br>
        <small class="text-muted">You can submit again after 24 hours.</small>
    `;

    form.parentElement.appendChild(summaryBox);
}

        });
    </script>





</body>

</html>
