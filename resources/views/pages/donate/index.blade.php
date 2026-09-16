@extends('layouts.main')

@section('main')
    <main class="main">

        <x-banner-card title="Make a Donation" current="Donate" />

        <!-- Donate Section -->
        <section id="donate" class="contact section">

            <div class="container">
                <div class="contact-wrapper">

                    <!-- Info Panel (Left Side) -->
                    <div class="contact-info-panel">
                        <div class="contact-info-header">
                            <h3>Support Our Mission</h3>
                            <p>Your contribution helps us continue delivering impactful programs
                                and supporting vulnerable communities across Tanzania.</p>
                        </div>

                        <div class="contact-info-cards">

                            <div class="info-card">
                                <div class="icon-container">
                                    <i class="bi bi-heart-fill"></i>
                                </div>
                                <div class="card-content">
                                    <h4>Why Donate?</h4>
                                    <p>Your donation supports community projects, health programs, empowerment
                                        initiatives, and youth development activities.</p>
                                </div>
                            </div>

                            <div class="info-card">
                                <div class="icon-container">
                                    <i class="bi bi-credit-card-2-front-fill"></i>
                                </div>
                                <div class="card-content">
                                    <h4>Payment Methods</h4>
                                    <p>We accept Mobile Money, Bank Transfer, and Online Payments.</p>
                                </div>
                            </div>

                            <div class="info-card">
                                <div class="icon-container">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <div class="card-content">
                                    <h4>Become a Monthly Donor</h4>
                                    <p>Your monthly support empowers sustainable long-term projects.</p>
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

                    <!-- Donation Form (Right Side) -->
                    <div class="contact-form-panel">

                       <div class="map-container" style="">
    <img src="{{ asset('img/SmallIcon-Donate.webp') }}" 
         alt="Donate"
         style="width: 100%; height: auto; border-radius: 12px; object-fit: contain;">
</div>

                        <div class="form-container">
                            <h3>Make a Donation</h3>
                            {{-- {{ route('donate.process') }} --}}
                            <form action="{{route('donate.store')}}" method="POST" id="donationForm">
                                @csrf

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
                                    <input type="number" class="form-control" id="amountInput" name="amount"
                                        placeholder="Donation Amount (TZS)" required="">
                                    <label for="amountInput">Donation Amount (TZS)</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <select class="form-select" id="methodInput" name="method" required>
                                        <option value="">-- Select Payment Method --</option>
                                        <option value="mpesa">M-Pesa</option>
                                        <option value="airtel_money">Airtel Money</option>
                                        <option value="tigo_pesa">Tigo Pesa</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                        <option value="online_card">Debit/Credit Card</option>
                                    </select>
                                    <label for="methodInput">Payment Method</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="messageInput" name="message" style="height: 120px" placeholder="Optional message"></textarea>
                                    <label for="messageInput">Message (Optional)</label>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn-submit">
                                        Donate Now <i class="bi bi-heart-fill ms-2"></i>
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </section>

    </main>

@endsection

@pushOnce('scripts')
     <script>
        document.addEventListener("DOMContentLoaded", function() {

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

@endPushOnce

