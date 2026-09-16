@extends("layouts.main")

@section('main')
<main class="main">
<x-banner-card  title="Our Contact" current="Contact" />
    <!-- Contact Section -->
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