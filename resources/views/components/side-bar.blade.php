<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">

            <x-logo />


        </div>
        <ul class="sidebar-menu">

            <li class="dropdown {{ Route::is('dashboad') ? 'active' : '' }} ">
                <a wire:navigate href="{{ route('dashboad') }}" class="nav-link">
                    <i data-feather="home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="dropdown ">
                <a target="_blank" href="{{ route('home') }}" class="nav-link"><i
                        data-feather="globe"></i><span>Website</span></a>
            </li>



            <li class="dropdown {{ Route::is('posts.index') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown "><i
                        data-feather="file-text"></i><span>Posts</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route("posts.index") }}">Post List</a></li>

                </ul>
            </li>
            <li class="dropdown {{ Route::is('events.index') ? 'active' : '' }}">
                <a href="{{ route('events.index') }}" class="menu-toggle nav-link has-dropdown "><i
                        data-feather="calendar"></i><span>Events
                    </span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" wire:navigate href="{{ route('events.index') }}">Event Lists</a></li>


                </ul>

            </li>

            @role("admin")
                      <li class="dropdown {{ Route::is('projects.index') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="folder"></i><span>Project</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" wire:navigate href="{{ route('projects.index') }}">Project LIst</a></li>


                </ul>
            </li>

            <li class="dropdown {{ Route::is('users.index') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" wire:navigate href="{{ route('users.index') }}">Users List</a></li>


                </ul>
            </li>

            <li class="dropdown {{ Route::is('clients.index') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="user-check"></i><span>clients</span></a>
                <ul class="dropdown-menu">

                    <li><a class="nav-link" href="{{ route('clients.index') }}">clients List</a></li>

                </ul>
            </li>

            <li class="dropdown {{ Route::is('volunteers.index') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="heart"></i><span>Volunteers</span></a>
                <ul class="dropdown-menu">

                    {{-- <li><a class="nav-link" href="{{ route('volunteers.index') }}">Volunteers List</a></li> --}}


                </ul>
            </li>

            <li class="dropdown {{ Route::is('members.index') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="users"></i><span>Members</span></a>
                <ul class="dropdown-menu">

                    <li><a class="nav-link" href="{{ route('members.index') }}">Members List</a></li>


                </ul>
            </li>
            <li class="dropdown {{ Route::is('members.index') ? 'active' : '' }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="link"></i><span>Category
                        Setting</span></a>
                <ul class="dropdown-menu">

                    <li><a class="nav-link" href="{{ route('categories.index') }}">Categories List</a></li>


                </ul>
            </li>

            {{-- Media --}}
<li class="dropdown {{ Route::is('videos.index') ? 'active' : '' }}">
    <a href="#" class="menu-toggle nav-link has-dropdown">
        <i data-feather="video"></i>
        <span>Media</span>
    </a>

    <ul class="dropdown-menu">
        <li>
            <a class="nav-link" href="{{ route('videos.index') }}">
                <i data-feather="video"></i>
                <span>Videos</span>
            </a>
        </li>
    </ul>
</li>

            </li>

            @endrole

  
        </ul>
    </aside>

</div>