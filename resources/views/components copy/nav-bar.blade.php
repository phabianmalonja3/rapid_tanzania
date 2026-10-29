<div>
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
                <li>
                    <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
                        <i data-feather="align-justify"></i>
                    </a>
                </li>

                <li>
                    <a href="#" class="nav-link nav-link-lg fullscreen-btn">
                        <i data-feather="maximize"></i>
                    </a>
                </li>

               
            </ul>
        </div>

        <ul class="navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" data-toggle="dropdown"
                   class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="{{auth()->user()->profile_img ? asset('storage/' . auth()->user()->profile_img) : asset('assets/img/no-profile.png')}}"  class="user-img-radious-style">
                </a>
                <div class="dropdown-menu dropdown-menu-right pullDown">
                    <div class="dropdown-title">Hellow {{ auth()->user()->last_name }}</div>
                    @role("admin")
                    <a href="{{ route('positions.index') }}" class="dropdown-item has-icon"> <i class="fas fa-cog"></i> Setting</a>
                    @endrole
                    <a href="{{ route('profiles.index') }}" class="dropdown-item has-icon"> <i class="far fa-user"></i> Profile</a>
                    <div class="ml-3">
                        <x-logout />
                    </div>
                   
                </div>
            </li>
        </ul>
    </nav>
</div>
