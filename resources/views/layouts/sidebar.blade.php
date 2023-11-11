<!-- ========== App Menu ========== -->

<div class="app-menu navbar-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('root') }}" class="logo logo-dark">
            <span class="logo-sm">
                <h2 class=""></h2>
                <img class="card-img-top img-fluid"
                     src="@if(get_general_setting('dark_logo_url') != "") {{get_general_setting('dark_logo_url')}} @else {{asset('assets/images/logo-dark.png')}} @endif">

            </span>
            <span class="logo-lg">
                <h2 class=""></h2>
                <img id="sidebar_logo_dark" class="card-img-top img-fluid"
                     src="@if(get_general_setting('dark_logo_url') != "") {{get_general_setting('dark_logo_url')}} @else {{asset('assets/images/logo-dark.png')}} @endif">
            </span>
        </a>
        <!-- Light Logo-->
        <a href=" {{ route('root') }}" class="logo logo-light">
            <span class="logo-sm">
                <h2 class="text-white"></h2>
                <img class="card-img-top img-fluid"
                     src="@if(get_general_setting('light_logo_url') != "") {{get_general_setting('light_logo_url')}} @else {{asset('assets/images/logo-light.png')}} @endif">
            </span>
            <span class="logo-lg ">
                <h2 class="text-white"></h2>
                 <img id="sidebar_logo_light" class="card-img-top img-fluid"
                      src="@if(get_general_setting('light_logo_url') != "") {{get_general_setting('light_logo_url')}} @else {{asset('assets/images/logo-light.png')}} @endif">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav"><!-- Shadows -->

                <li class="nav-item">
                    <a href="{{ route('root') }}" class="nav-link @if (\Route::is('root')) active @endif">
                        <i class="ri-dashboard-2-line"></i> <span>{{ lang('Dashboard') }}</span>
                    </a>
                </li>

                @include('layouts.dynamic-sidebar')
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>

</div>
<!-- Left Sidebar End -->

<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
