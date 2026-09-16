@extends("layouts.main")

@section('main')

<style>
    /* ============================================ */
    /* 1. EVENTS / ABOUT HEADER                     */
    /* ============================================ */
    .events-header {
        position: relative;
        background: linear-gradient(45deg, #0088cc, #005580);
        padding: 60px 0;
        color: white;
        overflow: hidden;
    }

    .events-header::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 86c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm66-3c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-40-39c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.4;
    }

    /* ============================================ */
    /* 2. PREMIUM EVENT CARD                        */
    /* ============================================ */
    .event-card {
        border: none;
        border-radius: 20px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        background: #fff;
        position: relative;
    }

    .event-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 22px 45px rgba(0, 0, 0, 0.08) !important;
    }

    .img-container {
        position: relative;
        overflow: hidden;
        border-radius: 20px 20px 0 0;
    }

    .img-container img {
        transition: transform 0.8s ease;
    }

    .event-card:hover .img-container img {
        transform: scale(1.1);
    }

    .date-badge {
        position: absolute;
        bottom: 15px;
        left: 15px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(5px);
        padding: 8px 15px;
        border-radius: 12px;
        font-weight: 800;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        z-index: 2;
    }

    .date-badge .day { color: #0088cc; font-size: 1.2rem; display: block; line-height: 1; }
    .date-badge .month { font-size: 0.7rem; text-transform: uppercase; color: #333; }

    .event-title-link {
        color: #2d3436;
        transition: all 0.3s ease;
        text-decoration: none;
        background-image: linear-gradient(#0088cc, #0088cc);
        background-position: 0% 100%;
        background-repeat: no-repeat;
        background-size: 0% 2px;
    }

    .event-card:hover .event-title-link {
        color: #0088cc !important;
        background-size: 100% 2px;
    }

    .btn-read-more {
        background: #f8f9fa;
        color: #0088cc;
        border-radius: 10px;
        transition: all 0.3s ease;
        font-size: 0.85rem;
    }

    .event-card:hover .btn-read-more {
        background: #0088cc;
        color: #fff;
    }

    /* ============================================ */
    /* 3. ABOUT PAGE - PREMIUM MEMIC STYLES         */
    /* ============================================ */

    /* About Card */
    .about-card {
        border-radius: 20px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        background: #fff;
        border: 1px solid #eef2f6;
        position: relative;
        overflow: hidden;
    }

    .about-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #0088cc, #00b4d8, #0088cc);
        background-size: 200% 100%;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .about-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(0, 136, 204, 0.12);
        border-color: #cce7f5;
    }

    .about-card:hover::before {
        opacity: 1;
        animation: shimmer 2s infinite linear;
    }

    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* Expertise Item */
    .expertise-item {
        padding: 25px;
        border-radius: 18px;
        background: linear-gradient(145deg, #f8fafc, #ffffff);
        border: 1px solid #eef2f6;
        height: 100%;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        overflow: hidden;
    }

    .expertise-item::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 3px;
        background: linear-gradient(90deg, #0088cc, #00b4d8);
        transition: width 0.4s ease;
        border-radius: 3px;
    }

    .expertise-item:hover {
        background: #fff;
        border-color: #0088cc;
        box-shadow: 0 20px 40px rgba(0, 136, 204, 0.1);
        transform: translateY(-8px);
    }

    .expertise-item:hover::after {
        width: 60%;
    }

    /* Icon Box */
    .icon-box-small {
        width: 55px;
        height: 55px;
        background: linear-gradient(135deg, rgba(0, 136, 204, 0.1), rgba(0, 180, 216, 0.15));
        color: #0088cc;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        font-size: 1.4rem;
        transition: all 0.4s ease;
        position: relative;
    }

    .expertise-item:hover .icon-box-small {
        background: linear-gradient(135deg, #0088cc, #00b4d8);
        color: #fff;
        transform: rotate(-5deg) scale(1.1);
        box-shadow: 0 10px 20px rgba(0, 136, 204, 0.3);
    }

    /* Section Header Custom */
    .section-header-custom {
        position: relative;
        padding-bottom: 18px;
        margin-bottom: 35px;
    }

    .section-header-custom::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #0088cc, #00b4d8);
        border-radius: 4px;
        transition: width 0.4s ease;
    }

    .section-header-custom:hover::after {
        width: 100px;
    }

    /* Partnership Tag */
    .partnership-tag {
        display: inline-block;
        padding: 10px 20px;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(0, 136, 204, 0.2);
        border-radius: 50px;
        margin: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #475569;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .partnership-tag:hover {
        background: #0088cc;
        color: #fff;
        border-color: #0088cc;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 136, 204, 0.25);
    }

    /* Stat Box */
    .stat-box {
        text-align: center;
        padding: 30px 20px;
        border-radius: 20px;
        background: linear-gradient(145deg, #ffffff, #f8fafc);
        border: 1px solid #eef2f6;
        transition: all 0.4s ease;
    }

    .stat-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 136, 204, 0.1);
        border-color: #0088cc;
    }

    .stat-box .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #0088cc, #00b4d8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
        margin-bottom: 10px;
    }

    .stat-box .stat-label {
        font-size: 0.9rem;
        color: #64748b;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Team Card */
    .team-card {
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
        border: 1px solid #eef2f6;
        transition: all 0.4s ease;
    }

    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0, 136, 204, 0.12);
        border-color: #0088cc;
    }

    .team-card .team-img {
        position: relative;
        overflow: hidden;
    }

    .team-card .team-img img {
        transition: transform 0.6s ease;
        width: 100%;
    }

    .team-card:hover .team-img img {
        transform: scale(1.1);
    }

    .team-card .team-social {
        position: absolute;
        bottom: -50px;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 136, 204, 0.95), transparent);
        padding: 20px;
        transition: bottom 0.4s ease;
        text-align: center;
    }

    .team-card:hover .team-social {
        bottom: 0;
    }

    .team-card .team-social a {
        color: #fff;
        margin: 0 8px;
        font-size: 1.1rem;
        transition: transform 0.3s ease;
        display: inline-block;
    }

    .team-card .team-social a:hover {
        transform: translateY(-3px);
    }
</style>
<main class="main">
<header class="events-header text-center">
    <div class="container position-relative" data-aos="fade-down">
        <span class="badge rounded-pill px-3 py-2 mb-3" style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3);">
            CONTACT US
        </span>
        <h2 class="display-5 fw-bold text-white mb-2">Get In Touch</h2>
        <p class="opacity-75 mx-auto" style="max-width: 600px;">We'd love to hear from you. Reach out to us for inquiries, partnerships, or any assistance you may need.</p>
    </div>
</header>
    <!-- Contact Section -->mai
    <section id="contact" class="contact section">

        <div class="container">
            <div class="contact-wrapper">
                <div class="contact-info-panel">
                    <div class="contact-info-header">
                        <h3>Contact Information</h3>
                        
                    </div>

                    <div class="contact-info-cards">
                        <div class="info-card">
                            <div class="icon-container">
                                <i class="bi bi-pin-map-fill"></i>
                            </div>
                            <div class="card-content">
                                <h4>Our Location</h4>
                                <p> Box 11189, Dar es Salaam. </p>
                               <p style="text-transform: capitalize;">
    mbezi beach, kwa zena off mwai kibaki road kahwa street plot 395
</p>

                            </div>
                        </div>

                        <div class="info-card">
                            <div class="icon-container">
                                <i class="bi bi-envelope-open"></i>
                            </div>
                            <div class="card-content">
                                <h4>Email Us</h4>
                                <p>info@rapidtanzania.org</p>
                                <p>rapidtanzania20@yahoo.com</p>
                            </div>
                        </div>

                        <div class="info-card">
                            <div class="icon-container">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div class="card-content">
                                <h4>Call Us</h4>
                                <p>+255 754 458 960</p>
                                <p>+255 715 022 411</p>
                            </div>
                        </div>

                        <div class="info-card">
                            <div class="icon-container">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <div class="card-content">
                                <h4>Working Hours</h4>
                                <p>Monday-Saturday: 9AM - 7PM</p>
                            </div>
                        </div>
                    </div>

                    <div class="social-links-panel">
                        <h5>Follow Us</h5>
                        <div class="social-icons">
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-twitter-x"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                            <a href="#"><i class="bi bi-youtube"></i></a>
                        </div>
                    </div>
                </div>

                <div class="contact-form-panel">
                 <div class="map-container" style="width: 100%; height: 400px;">
  <iframe
    src="https://www.google.com/maps?q=Mbezi%20Beach%20Mosque%20Kwa%20Zena%2C%20Mwai%20Kibaki%20Rd%2C%20Dar%20es%20Salaam&t=&z=15&ie=UTF8&iwloc=&output=embed"
    width="100%"
    height="100%"
    style="border:0;"
    allowfullscreen=""
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade">
  </iframe>
</div>


                    <div class="form-container">
                        <h3>Send Us a Message</h3>
                        {{-- <p>You can</p> --}}

                        <form action="forms/contact.php" method="post" class="php-email-form">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nameInput" name="name"
                                    placeholder="Full Name" required="">
                                <label for="nameInput">Full Name</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="emailInput" name="email"
                                    placeholder="Email Address" required="">
                                <label for="emailInput">Email Address</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="subjectInput" name="subject"
                                    placeholder="Subject" required="">
                                <label for="subjectInput">Subject</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="messageInput" name="message" rows="5"
                                    placeholder="Your Message" style="height: 150px" required=""></textarea>
                                <label for="messageInput">Your Message</label>
                            </div>

                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn-submit">Send Message <i
                                        class="bi bi-send-fill ms-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Contact Section -->

</main>
@endsection