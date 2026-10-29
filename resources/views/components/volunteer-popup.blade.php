<div id="volunteerPopup" class="volunteer-popup-overlay" aria-hidden="true">
    <div class="volunteer-popup" role="dialog" aria-modal="true"
         aria-labelledby="volunteerTitle">

        <button type="button" class="volunteer-close"
                id="closeVolunteerPopup" aria-label="Close">
            &times;
        </button>

        <div class="volunteer-icon">
            <i class="fas fa-hands-helping"></i>
        </div>

        <span class="volunteer-badge">Make a Difference</span>

        <h2 id="volunteerTitle">Become a Volunteer</h2>

        <p>
            Join our team of passionate volunteers and help us make
            a positive impact in our community.
        </p>

        <div class="volunteer-actions">
            <a href="{{ route('volunteer.create') }}"
               class="volunteer-btn">
                Volunteer Now
                <i class="fas fa-arrow-right"></i>
            </a>

            <button type="button" class="volunteer-later"
                    id="laterVolunteerPopup">
                Maybe Later
            </button>
        </div>

        <small>Your time and skills can make a difference.</small>
    </div>
</div>

<style>
    .volunteer-popup-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.72);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        z-index: 99999;
        opacity: 0;
        visibility: hidden;
        transition: opacity .3s ease, visibility .3s ease;
    }

    .volunteer-popup-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .volunteer-popup {
        position: relative;
        background: #fff;
        width: 100%;
        max-width: 460px;
        padding: 42px 32px 30px;
        border-radius: 20px;
        text-align: center;
        box-shadow: 0 25px 80px rgba(0, 0, 0, .2);
        transform: translateY(20px);
        transition: transform .3s ease;
    }

    .volunteer-popup-overlay.active .volunteer-popup {
        transform: translateY(0);
    }

    .volunteer-close {
        position: absolute;
        top: 14px;
        right: 17px;
        border: none;
        background: #f1f5f9;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        font-size: 25px;
        cursor: pointer;
        color: #334155;
    }

    .volunteer-icon {
        width: 76px;
        height: 76px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        background: #e6f5ec;
        color: #198754;
        border-radius: 50%;
        font-size: 32px;
    }

    .volunteer-badge {
        display: inline-block;
        background: #e6f5ec;
        color: #198754;
        padding: 7px 14px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .volunteer-popup h2 {
        color: #172b24;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .volunteer-popup p {
        color: #64748b;
        font-size: 15px;
        line-height: 1.8;
        margin-bottom: 25px;
    }

    .volunteer-actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .volunteer-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: #198754;
        color: #fff;
        padding: 15px 20px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        transition: background .2s ease;
    }

    .volunteer-btn:hover {
        background: #146c43;
        color: #fff;
    }

    .volunteer-later {
        background: transparent;
        border: none;
        padding: 10px;
        color: #64748b;
        cursor: pointer;
    }

    .volunteer-popup small {
        display: block;
        margin-top: 18px;
        color: #94a3b8;
        font-size: 12px;
    }

    @media (max-width: 480px) {
        .volunteer-popup {
            padding: 38px 22px 25px;
        }

        .volunteer-popup h2 {
            font-size: 24px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const popup = document.getElementById('volunteerPopup');
        const closeButton = document.getElementById('closeVolunteerPopup');
        const laterButton = document.getElementById('laterVolunteerPopup');

        if (!popup) return;

        const COOKIE_NAME = 'volunteer_popup_dismissed';

        function getCookie(name) {
            const prefix = name + '=';
            const cookies = document.cookie.split(';');

            for (let cookie of cookies) {
                cookie = cookie.trim();

                if (cookie.startsWith(prefix)) {
                    return decodeURIComponent(
                        cookie.substring(prefix.length)
                    );
                }
            }

            return null;
        }

        function setDismissedCookie() {
            const expiryDate = new Date();
            expiryDate.setDate(expiryDate.getDate() + 7);

            const secure = window.location.protocol === 'https:'
                ? '; Secure'
                : '';

            document.cookie =
                COOKIE_NAME + '=true' +
                '; expires=' + expiryDate.toUTCString() +
                '; path=/' +
                '; SameSite=Lax' +
                secure;
        }

        function closePopup() {
            setDismissedCookie();
            popup.classList.remove('active');
            popup.setAttribute('aria-hidden', 'true');
        }

        if (!getCookie(COOKIE_NAME)) {
            setTimeout(function () {
                popup.classList.add('active');
                popup.setAttribute('aria-hidden', 'false');
            }, 2000);
        }

        closeButton.addEventListener('click', closePopup);
        laterButton.addEventListener('click', closePopup);

        popup.addEventListener('click', function (event) {
            if (event.target === popup) {
                closePopup();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (
                event.key === 'Escape' &&
                popup.classList.contains('active')
            ) {
                closePopup();
            }
        });
    });
</script>