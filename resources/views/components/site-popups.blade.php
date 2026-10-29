
<div id="cookieBanner" class="cookie-banner">
    <div class="cookie-content">
        <div class="cookie-icon">
            <i class="fas fa-cookie-bite"></i>
        </div>

        <div class="cookie-text">
            <h5>We Value Your Privacy</h5>
            <p>
                We use cookies to improve your browsing experience,
                analyze website traffic, and provide better services.
                By clicking "Accept Cookies", you agree to our use of cookies.
            </p>
        </div>
    </div>

    <div class="cookie-actions">
        <button type="button" id="acceptCookies" class="cookie-accept-btn">
            Accept Cookies
        </button>

        <button type="button" id="rejectCookies" class="cookie-reject-btn">
            Reject Optional Cookies
        </button>
    </div>
</div>


{{-- Become a Volunteer Popup --}}
<div id="volunteerModal" class="volunteer-overlay">
    <div class="volunteer-modal">

        <button type="button"
                id="closeVolunteerModal"
                class="volunteer-close"
                aria-label="Close volunteer popup">
            &times;
        </button>

        <div class="volunteer-image">
            <img
                src="{{ asset('img/volunteer.jpg') }}"
                alt="Become a volunteer"
                onerror="this.style.display='none';"
            >

            <div class="volunteer-image-overlay"></div>

            <div class="volunteer-image-text">
                <span>MAKE A DIFFERENCE</span>
                <h2>Be the Change<br>You Want to See</h2>
            </div>
        </div>

        <div class="volunteer-body">
            <span class="volunteer-badge">
                JOIN OUR COMMUNITY
            </span>

            <h3>Become a Volunteer</h3>

            <p>
                Your time, skills, and passion can make a real difference.
                Join our team of volunteers and help us create a better
                future for our community.
            </p>

            <a href="{{ route('volunteer.create') }}"
               class="volunteer-cta">
                Become a Volunteer
                <i class="fas fa-arrow-right"></i>
            </a>

            <button type="button"
                    id="volunteerLater"
                    class="volunteer-later">
                Maybe Later
            </button>
        </div>

    </div>
</div>


<style>

    :root {
    --primary-color: #0088cc;
    --default-font: "Poppins", sans-serif;
    --heading-font: "Poppins", sans-serif;
}
    /* Cookie consent banner */
    .cookie-banner {
        position: fixed;
        bottom: 20px;
        left: 20px;
        width: min(600px, calc(100% - 40px));
        background: #fff;
        padding: 24px;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.18);
        z-index: 9998;
        display: none;
        font-family: Arial, sans-serif;
    }

    .cookie-content {
        display: flex;
        gap: 15px;
        align-items: flex-start;
    }

    .cookie-icon {
        width: 45px;
        height: 45px;
        min-width: 45px;
        background: #f0f7ed;
        color:  #0088cc;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .cookie-text h5 {
        margin: 0 0 8px;
        font-size: 18px;
        font-weight: 700;
        color: #17251b;
    }

    .cookie-text p {
        margin: 0;
        color: #667085;
        font-size: 13px;
        line-height: 1.7;
    }

    .cookie-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .cookie-actions button {
        padding: 11px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 600;
        transition: 0.3s;
    }

    .cookie-accept-btn {
        background:  #0088cc;
        color: #fff;
        border: 1px solid  #0088cc;
    }

    .cookie-accept-btn:hover {
        background:  #0088cc;
    }

    .cookie-reject-btn {
        background: #fff;
        color: #344054;
        border: 1px solid #d0d5dd;
    }

    .cookie-reject-btn:hover {
        background: #f9fafb;
    }


    /* Volunteer popup overlay */
    .volunteer-overlay {
        position: fixed;
        inset: 0;
        background: rgba(10, 20, 15, 0.7);
        backdrop-filter: blur(4px);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        z-index: 9999;
    }

    .volunteer-modal {
        position: relative;
        display: grid;
        grid-template-columns: 1fr 1fr;
        width: min(850px, 100%);
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 20px 70px rgba(0, 0, 0, 0.25);
        animation: volunteerAppear 0.4s ease;
    }

    .volunteer-close {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 5;
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.95);
        color: #222;
        font-size: 27px;
        line-height: 1;
        cursor: pointer;
    }

    .volunteer-image {
        position: relative;
        min-height: 390px;
        background:  #0088cc;
        overflow: hidden;
    }

    .volunteer-image img {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
        inset: 0;
    }

    .volunteer-image-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to top,
            rgba(0, 0, 0, 0.8),
            rgba(0, 0, 0, 0.05)
        );
    }

    .volunteer-image-text {
        position: absolute;
        bottom: 35px;
        left: 25px;
        right: 20px;
        color: #fff;
    }

    .volunteer-image-text span {
        display: inline-block;
        margin-bottom: 12px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .volunteer-image-text h2 {
        margin: 0;
        font-size: 30px;
        line-height: 1.3;
        color: #fff;
    }

    .volunteer-body {
        padding: 55px 30px 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .volunteer-badge {
        align-self: flex-start;
        background: #edf7eb;
        color:  #0088cc;
        padding: 8px 12px;
        border-radius: 30px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .volunteer-body h3 {
        margin: 20px 0 12px;
        color: #17251b;
        font-size: 27px;
        font-weight: 700;
    }

    .volunteer-body p {
        color: #667085;
        font-size: 14px;
        line-height: 1.8;
        margin-bottom: 25px;
    }

    .volunteer-cta {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        width: 100%;
        padding: 15px 18px;
        border-radius: 8px;
        background:  #0088cc;
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        transition: 0.3s;
    }

    .volunteer-cta:hover {
        background:  #0088cc;
        color: #fff;
        transform: translateY(-2px);
    }

    .volunteer-later {
        background: transparent;
        border: none;
        color: #667085;
        padding: 15px;
        margin-top: 5px;
        cursor: pointer;
        font-size: 13px;
    }

    .volunteer-later:hover {
        color:  #0088cc;
    }

    @keyframes volunteerAppear {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* Mobile responsive */
    @media (max-width: 650px) {
        .volunteer-overlay {
            padding: 15px;
        }

        .volunteer-modal {
            grid-template-columns: 1fr;
            max-width: 420px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .volunteer-image {
            min-height: 190px;
        }

        .volunteer-image-text {
            bottom: 20px;
            left: 20px;
        }

        .volunteer-image-text h2 {
            font-size: 24px;
        }

        .volunteer-body {
            padding: 25px 22px;
        }

        .volunteer-body h3 {
            margin-top: 15px;
            font-size: 23px;
        }

        .cookie-banner {
            left: 10px;
            bottom: 10px;
            width: calc(100% - 20px);
            padding: 18px;
        }

        .cookie-actions {
            flex-direction: column;
        }

        .cookie-actions button {
            width: 100%;
        }
    }
</style>


<script>
document.addEventListener('DOMContentLoaded', function () {

    // Cookie consent
    const cookieBanner = document.getElementById('cookieBanner');
    const acceptCookies = document.getElementById('acceptCookies');
    const rejectCookies = document.getElementById('rejectCookies');

    // Volunteer popup
    const volunteerModal = document.getElementById('volunteerModal');
    const closeVolunteerModal = document.getElementById('closeVolunteerModal');
    const volunteerLater = document.getElementById('volunteerLater');

    // Show cookie banner if the user has not made a choice
    if (!localStorage.getItem('cookieConsent')) {
        cookieBanner.style.display = 'block';
    }

    // Accept cookies
    acceptCookies.addEventListener('click', function () {
        localStorage.setItem('cookieConsent', 'accepted');
        cookieBanner.style.display = 'none';
    });

    // Reject optional cookies
    rejectCookies.addEventListener('click', function () {
        localStorage.setItem('cookieConsent', 'rejected');
        cookieBanner.style.display = 'none';
    });

    // Show volunteer popup after 5 seconds, once per browser session
    if (!sessionStorage.getItem('volunteerPopupDismissed')) {
        setTimeout(function () {
            volunteerModal.style.display = 'flex';
        }, 5000);
    }

    // Close volunteer popup
    function closeVolunteerPopup() {
        volunteerModal.style.display = 'none';
        sessionStorage.setItem('volunteerPopupDismissed', 'true');
    }

    closeVolunteerModal.addEventListener('click', closeVolunteerPopup);
    volunteerLater.addEventListener('click', closeVolunteerPopup);

    // Close when clicking outside the popup
    volunteerModal.addEventListener('click', function (event) {
        if (event.target === volunteerModal) {
            closeVolunteerPopup();
        }
    });

    // Close with Escape key
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' &&
            volunteerModal.style.display === 'flex') {
            closeVolunteerPopup();
        }
    });

});
</script>