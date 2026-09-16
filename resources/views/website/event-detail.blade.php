@extends("layouts.main")

@section('main')

<main class="main">

    {{-- Hero/Header Section (Adjusted from your original code to be generic) --}}

   <x-banner-card  :title="$event->name" current="Event" />

    {{-- Blog Content Section --}}
    <section id="blog-content" class="blog-content section py-5">
        
        <div class="container">
             <div class="container section-title text-center mb-5">
        <h2>Detail For {{$event->name}}</h2>
        
    </div>
            <div class="row">

                {{-- Main Blog Post Content (Left Column - Matches Image 1) --}}
                <div class="col-lg-8">
                    <article class="post-details">
                        {{-- Feature Image (Matches Image 2) --}}
                        <div class="post-image mb-4">
                           
                            {{-- Replace this with an actual image, perhaps fetched from a model --}}
                            <img src="{{ asset('storage/'.$event->images[0]) }}" class="img-fluid mb-2"
                                alt="Blog Feature Image" >
                        </div>

                        <h2 class="post-title py-4 col-4">{{ $event->name }}</h2>

                        
                        <div class="post-body">
                            <p class="container">
                               {{ $event->description }}
                            </p>


                            {{-- Highlighted Blockquote/Box (Matches Image 1) --}}
                            <div class="highlight-box my-4 p-4 border-start border-3 border-info bg-light">
                               RAPID Tanzania, a non-governmental organization registered under the NGO law of the Tanzania Act of 2002. It is a team of professionals with extensive experience in disaster management and Disaster Risk Reduction.
                            </div>

                            
                        </div>

                        {{-- You would typically include a section for comments/related posts here --}}

                    </article>
                </div>

                {{-- Sidebar Content (Right Column - Matches Both Images) --}}
                <div class="col-lg-4">
                    <div class="sidebar">

                        {{-- Search Bar (Matches Image 2) --}}
                        <div class="sidebar-item search-form mb-4">
                            <form action="#" method="GET">
                                <input type="text" name="search" placeholder="Search...">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                            </form>
                        </div>

                        {{-- Categories (Matches Image 2) --}}
                       <div class="sidebar-item categories mb-4">
    <h3 class="sidebar-title">Categories</h3>
    <ul>
        @php
            use App\Models\Category;
            // Assume $currentCategory is passed from your controller (e.g., $post->category_id)
            $currentCategoryId = $currentCategory ?? null; 
            $categories = Category::limit(6)->get();
        @endphp
        
        @foreach ($categories as $cat)
            {{-- Conditionally add the 'active' class --}}
            <li class="{{ ($cat->id == $currentCategoryId) ? 'active' : '' }}">
                <a href="{{ route('events.show', $cat->slug) }}">
                    {{ $cat->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

                        {{-- Recent Posts (Matches Image 1) --}}

                        @use('App\Models\Event',"Event" )
                        
                        <div class="sidebar-item recent-posts">
                            <h3 class="sidebar-title">Recent Posts</h3>

                            @foreach (Event::latest()->paginate(4) as $event)
                                
                            <div class="post-item">
                                <a href="{{ route('event-view',$event->slug) }}">

                                    <img src="{{ asset('storage/'.$event->images[0]) }}" alt="{{ $event->name }}"
                                        class="img-fluid float-start me-3">
                                    <div class="post-info">
                                        <h4>{{ $event->name }}</h4>
                                        <time datetime="2018-08-20">{{ $event->created_at->format("Y,M,D") }}</time>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                           
                        </div>

                        {{-- 🖼️ NEW: Image Gallery Section --}}
                        <div class="post-image-gallery mt-5 pt-3 border-top">
                            <h3>Other Images</h3>
                            <div class="row">
                                @foreach ($images as $imageUrl)
                                <div class="col-md-4 col-6 mb-4">
                                
                                    <a href="{{ asset('storage/'.$imageUrl) }}" target="_blank">
                                        <img src="{{ asset('storage/'.$imageUrl) }}" class="img-fluid gallery-thumb" alt="Post Image">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
@endsection