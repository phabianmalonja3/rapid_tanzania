<footer id="footer" class="footer dark-background">

    <div class="container footer-top">
        <div class="row gy-4">

            <div class="col-lg-3 col-md-12 footer-about">
                <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                    <img src="{{ asset('assets/img/logo1.png') }}" alt="">
                    <span class="sitename">RAPID Tanzania</span>
                </a>
                <p> Response and Preparedness in Disasters (RAPID-Tanzania) is a Non-Governmental Organization
                    registered</p>
                <div class="social-links d-flex mt-4">
                    <a href="https://x.com/rapidtanzania"><i class="bi bi-twitter-x"></i></a>
                    <a href="https://www.facebook.com/p/Rapid-Tanzania-100086516116398/"><i
                            class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/rapidtanzania/reels/"><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                    <a href="{{ route('login') }}"><i class="bi bi-person-circle"></i></a>
                </div>
            </div>

            {{-- ============================================ --}}
            {{-- VIDEO MBILI ZA MWISHO KUTOKA DATABASE          --}}
            {{-- ============================================ --}}
            @php
                // Chukua video mbili za mwisho zilizo Active
                $footerVideos = \App\Models\Video::
                                    latest()
                                    ->take(2)
                                    ->get();
            @endphp

            @forelse($footerVideos as $video)
                <div class="col-lg-3 col-6 footer-videos text-center">
                    <h4>{{ $video->title ?? 'Video' }}</h4>
                    <video width="100%" autoplay muted loop playsinline controls
                        poster="{{ $video->thumbnail ? asset( $video->thumbnail) : '' }}">
                        @if($video->url)
                            <source src="{{ $video->url }}" type="video/mp4">
                        @elseif($video->video_file)
                            <source src="{{ asset( $video->video_file) }}" type="video/mp4">
                        @endif
                        Your browser does not support the video tag.
                    </video>
                </div>
            @empty
                {{-- Kama hakuna video kwenye database, tunaonyesha ujumbe --}}
                <div class="col-lg-3 col-6 footer-videos text-center">
                    <h4>Video</h4>
                    <p class="text-white">Hakuna video kwa sasa.</p>
                </div>
                <div class="col-lg-3 col-6 footer-videos text-center">
                    <h4>Video</h4>
                    <p class="text-white">Hakuna video kwa sasa.</p>
                </div>
            @endforelse

            <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                <h4>Contact Us</h4>
                <p>Postal address: P.O Box 11189, Dar es Salaam.</p>
                <p>Physical address: Mwai Kibaki road, Mbezi Beach - Kwa Zena (Behind Capital Plaza)</p>
                <p class="mt-4"><strong>Phone:</strong> <span>+255 715 022 411</span></p>
                <p class="mt-4"><strong>Phone:</strong> <span>+255 754 458 960</span></p>
                <p><strong>Email:</strong> <span>info@rapidtanzania.org</span></p>
                <p><strong>Email:</strong> <span>rapidtanzania20@yahoo.com</span></p>
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">RAPID-Tanzania</strong> <span>All Rights
                Reserved</span></p>
        <div class="credits">
            Designed by <a href="mailto:phabianmalonja3@gmail.com">phabianmalonja3@gmail.com</a>
        </div>
    </div>

</footer>