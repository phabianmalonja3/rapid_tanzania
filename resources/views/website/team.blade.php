@extends("layouts.main")

@section("title")
Board Members - RAPID Tanzania
@endsection

@section('main')
<style>
    /* Clean Team Section Styling */
    .team {
        background-color: #fcfdfe;
        padding: 80px 0;
    }

    .section-title h2 {
        font-weight: 800;
        color: #102a49;
        text-transform: uppercase;
    }

    .title-line {
        width: 60px;
        height: 3px;
        background: #0088cc;
        margin: 15px auto;
        border-radius: 2px;
    }

    /* Card */
    .team-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #eef2f6;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        text-align: center;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    /* Image Container */
    .member-photo {
        position: relative;
        margin: 20px;
        overflow: hidden;
        border-radius: 14px;
        aspect-ratio: 1 / 1;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Image Fix */
    .member-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center 20%;
        filter: grayscale(100%);
        transition: all 0.6s ease;
    }

    /* Hover Effects */
    .team-card:hover {

        border-color: rgba(0, 136, 204, 0.3);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 136, 204, 0.1);
        transform: translateY(-6px);
    }

    .team-card:hover .member-img {
        filter: grayscale(0%);
        transform: scale(1.08);
    }

    /* Info Area */
    .member-summary {
        padding: 10px 20px 30px;
        margin-top: auto;
    }

    .member-summary h5 {
        font-weight: 700;
        margin-bottom: 6px;
        color: #102a49;
        font-size: 1.1rem;
    }

    .member-summary span {
        display: block;
        color: #0088cc;
        font-size: 0.78rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Responsive polish */
    @media (max-width: 768px) {
        .team {
            padding: 60px 0;
        }

        .member-photo {
            margin: 15px;
        }
    }
</style>

<main class="main">

    <x-banner-card title="OUR BOARD MEMBERS" current="Our Board Members" />

    <section id="team" class="team">
        <div class="container" data-aos="fade-up">

            <div class="row gy-4">
                @foreach ($members as $member)
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                    <div class="team-card shadow-sm">

                        <div class="member-photo">
                            @if($member->image)
                                <img
                                    src="{{ asset('storage/'.$member->image) }}"
                                    class="member-img"
                                    alt="{{ $member->full_name }}"
                                    loading="lazy"
                                >
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 w-100 bg-light text-muted">
                                    <i class="bi bi-person-fill display-1 opacity-25"></i>
                                </div>
                            @endif
                        </div>

                        <div class="member-summary">
                            <h5>{{ $member->full_name }}</h5>
                            <span>{{ $member->position->name ?? "Board Member" }}</span>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

</main>
@endsection
