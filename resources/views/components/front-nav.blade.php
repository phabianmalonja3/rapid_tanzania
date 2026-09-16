<style>
    /* Compact Navigation Styling */
    .navmenu {
        padding: 0;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .navmenu ul {
        margin: 0;
        padding: 0;
        display: flex;
        list-style: none;
        align-items: center;
    }

    .navmenu li {
        position: relative;
    }

    /* Main Links - Small & Clean */
    .navmenu a, 
    .navmenu a:focus {
        color: #444;
        padding: 8px 12px !important; /* Reduced vertical padding */
        font-size: 14px; /* Smaller professional font */
        font-weight: 500;
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: 0.3s;
    }

    .navmenu a i {
        font-size: 10px; /* Tiny icons */
        margin-left: 5px;
        line-height: 0;
    }

    /* Active & Hover States */
    .navmenu a:hover, 
    .navmenu a.active, 
    .navmenu li:hover > a {
        color: #0088cc !important;
    }

    /* Dropdown Menus - Compact */
    .navmenu .dropdown ul {
        margin: 0;
        padding: 5px 0;
        background: #fff;
        display: block;
        position: absolute;
        visibility: hidden;
        left: 0;
        top: 100%;
        opacity: 0;
        z-index: 99;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        transition: 0.3s;
        border-top: 2px solid #0088cc;
        border-radius: 4px;
        min-width: 180px;
    }

    .navmenu .dropdown:hover > ul {
        opacity: 1;
        visibility: visible;
    }

    .navmenu .dropdown ul a {
        padding: 6px 15px !important;
        font-size: 13px; /* Slightly smaller text for sub-items */
        font-weight: 400;
        color: #444;
    }

    /* Nested Dropdown (Level 3) */
    .navmenu .dropdown ul .dropdown ul {
        top: 0;
        left: 100%;
    }

    /* Compact Donate Button */
    .donate-btn {
        background: #0088cc;
        color: #fff !important;
        padding: 6px 18px !important; /* Small button padding */
        margin-left: 15px;
        border-radius: 50px;
        font-size: 13px !important;
        font-weight: 600;
        transition: 0.3s;
        box-shadow: 0 2px 5px rgba(0, 136, 204, 0.2);
    }

    .donate-btn:hover {
        background: #0077b3 !important;
        box-shadow: 0 4px 10px rgba(0, 136, 204, 0.3);
        transform: translateY(-1px);
    }

    /* Mobile Toggle */
    .mobile-nav-toggle {
        font-size: 24px;
        cursor: pointer;
        margin-left: 15px;
        color: #444;
    }
</style>

<nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">Home</a></li>

        @use('App\Models\Category')
        @php
            // Fetch categories with projects, keeping the list light
            $categories = Category::with('projects')->latest()->get();
        @endphp

        <li class="dropdown">
            <a href="#"><span>Programs</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                @foreach ($categories as $category)
                    <li class="dropdown">
                        <a href="#">
                            <span>{{ $category->name }}</span> 
                            <i class="bi bi-chevron-right ms-auto"></i>
                        </a>
                        <ul>
                            @foreach ($category->projects as $project)
                                <li>
                                    <a href="{{ route('project-show', $project->slug) }}"> 
                                        {{ \Illuminate\Support\Str::limit($project->title, 25) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </li>

        <li><a href="{{ route('member-list') }}" class="{{ Route::is('member-list') ? 'active' : '' }}">Members</a></li>
        
        <li><a href="{{ route('event-list') }}" class="{{ Route::is('event-list') ? 'active' : '' }}">News</a></li>
        
        <li><a href="{{ route('about') }}" class="{{ Route::is('about') ? 'active' : '' }}">About</a></li>

        @auth
            <li><a href="{{ route('dashboad') }}" class="{{ Route::is('dashboad') ? 'active' : '' }}">Dashboard</a></li>
        @endauth

        <li><a href="{{ route('contact') }}" class="{{ Route::is('contact') ? 'active' : '' }}">Contact</a></li>

        <li>
    <a href="{{ route('donate') }}" class="donate-btn">
        <i class="bi bi-heart-fill me-2"></i>Donate
    </a>
</li>
    </ul>

    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>