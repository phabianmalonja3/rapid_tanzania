
@extends('layouts.main')

@section('main')
<main class="main">

    <section class="py-5">
        <div class="container">

            <div class="text-center mb-5">
                <span class="text-primary fw-bold">
                    JOIN OUR COMMUNITY
                </span>

                <h1 class="mt-2">Become a Volunteer</h1>

                <p class="text-muted">
                    Share your time and skills to make a difference
                    in our community.
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-7">

                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-md-5">

                            <form action="#" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">
                                        Full Name
                                    </label>

                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="form-control"
                                        placeholder="Enter your full name"
                                        required
                                    >
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        Email Address
                                    </label>

                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control"
                                        placeholder="Enter your email"
                                        required
                                    >
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">
                                        Phone Number
                                    </label>

                                    <input
                                        type="tel"
                                        name="phone"
                                        id="phone"
                                        class="form-control"
                                        placeholder="Enter your phone number"
                                        required
                                    >
                                </div>

                                <div class="mb-3">
                                    <label for="interest" class="form-label">
                                        Area of Interest
                                    </label>

                                    <select
                                        name="interest"
                                        id="interest"
                                        class="form-select"
                                        required
                                    >
                                        <option value="">
                                            Select an area
                                        </option>

                                        <option value="community">
                                            Community Development
                                        </option>

                                        <option value="education">
                                            Education
                                        </option>

                                        <option value="environment">
                                            Environment
                                        </option>

                                        <option value="health">
                                            Health
                                        </option>

                                        <option value="other">
                                            Other
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="message" class="form-label">
                                        Tell Us About Yourself
                                    </label>

                                    <textarea
                                        name="message"
                                        id="message"
                                        class="form-control"
                                        rows="4"
                                        placeholder="Why would you like to become a volunteer?"
                                        required
                                    ></textarea>
                                </div>

                                <button
                                    type="submit"
                                    class="btn btn-primary w-100 py-3 rounded-sm"
                                >
                                    Submit Application
                                </button>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

</main>
@endsection
