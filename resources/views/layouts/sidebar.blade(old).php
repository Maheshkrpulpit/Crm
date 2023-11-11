<!-- ========== App Menu ========== -->

<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{url('/')}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{url('/')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>@lang('translation.menu')</span></li>
                            <li class="nav-item">
                                <a href="{{url('/')}}" class="nav-link @if(\Request::is('/') active @endif"> <i class="ri-dashboard-2-line"></i> <span>@lang('translation.dashboards')</span></a>
                            </li>


                     <li class="nav-item">
                                <a href="#sidebarUsers" class="@if(\Route::is(['users.*','roles.*'])) active collapsed @endif nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUsers"><i class="ri-team-line"></i><span> @lang('user.manage_users')</span>
                                </a>
                                <div class="collapse menu-dropdown @if(\Route::is(['users.*','roles.*'])) show @endif" id="sidebarUsers">
                                    <ul class="nav nav-sm flex-column">
                                        @can('user.view')
                                        <li class="nav-item">
                                            <a href="{{route('users.index')}}" class="nav-link @if(\Route::is(['users.*'])) active @endif">@lang('user.users')</a>
                                        </li>
                                        @endcan
                                        @can('roles.view')
                                         <li class="nav-item">
                                            <a href="{{route('roles.index')}}" class="nav-link @if(\Route::is(['roles.*'])) active @endif">@lang('user.roles')</a>
                                        </li>
                                        @endcan
                                      
                                    </ul>
                                </div>
                            </li>
                            <!--Module -->
                            
                            <li class="nav-item">
                                <a href="{{route('manage-modules.index')}}" class="@if(\Route::is(['manage-modules.*'])) active @endif nav-link" ><i class="ri-plug-line"></i> @lang('Modules')
                                </a>
                            </li>

                            <!--End -->

                            <!-- Settings -->
                            <li class="nav-item">
                                <a href="#sidebarSettings" class="@if(\Route::is(['settings.*'])) active collapsed @endif nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSettings"><i class=" ri-settings-2-line"></i><span> @lang('settings.business.settings')</span>
                                </a>
                                <div class="collapse menu-dropdown @if(\Route::is(['settings.*'])) show @endif" id="sidebarSettings">
                                    <ul class="nav nav-sm flex-column">

                            <li class="nav-item">
                                <a href="{{route('settings.business.create')}}" class="nav-link @if(\Route::is(['settings.business.*'])) active @endif">@lang('settings.business.business_settings')</a>
                            </li>

                            </ul>
                            </div>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarRegistration" class="@if(\Route::is(['university.reports.registration_reports','university.students.index','university.exam.index'])) active collapsed @endif nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarRegistration"><i class=" ri-database-fill"></i><span> @lang('Registration')</span>
                                </a>
                                <div class="collapse menu-dropdown @if(\Route::is(['university.reports.registration_reports','university.students.index','university.exam.index'])) show @endif" id="sidebarRegistration">
                                    <ul class="nav nav-sm flex-column">

                            <li class="nav-item">
                               <a href="{{route('university.reports.registration_reports')}}" class="@if(\Route::is(['university.reports.registration_reports'])) active @endif nav-link" >
                                    
                                    @lang('RR')
                               </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('university.students.index')}}" class="@if(\Route::is(['university.students.index'])) active @endif nav-link" >
                                     
                                     @lang('List')
                                </a>
                            </li>

                            <li class="nav-item">
                               <a href="{{route('university.exam.index')}}" class="@if(\Route::is(['university.exam.index'])) active @endif nav-link" >
                                    
                                    @lang('Exam Opening Forms')
                               </a>
                            </li>

                        </ul>
                    </div></li>


                            <!-- master settings -->
                            <li class="nav-item">
                                <a href="#sidebarMasterSettings" class="@if(\Route::is(['university.*'])) active collapsed @endif nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMasterSettings"><i class="ri-compasses-2-line"></i><span> @lang('University Master')</span>
                                </a>
                                <div class="collapse menu-dropdown @if(\Route::is(['university.program_types.*','university.colleges.*','university.courses.*','university.subjects.*','university.session_settings.*'])) show @endif" id="sidebarMasterSettings">
                                    <ul class="nav nav-sm flex-column">
                                        
                                        <li class="nav-item">
                                            <a href="{{route('university.program_types.index')}}" class="nav-link @if(\Route::is(['university.program_types.*'])) active @endif">@lang('Program')</a>
                                        </li>
                                     
                                        <li class="nav-item">
                                            <a href="{{route('university.session_settings.index')}}" class="nav-link @if(\Route::is(['university.session_settings.*'])) active @endif">@lang('university::university.session_setting')</a>
                                        </li>

                                         <li class="nav-item">
                                            <a href="{{route('university.colleges.index')}}" class="nav-link @if(\Route::is(['university.colleges.*'])) active @endif">@lang('university::university.colleges')</a>
                                        </li>

                                         <li class="nav-item">
                                            <a href="{{route('university.courses.index')}}" class="nav-link @if(\Route::is(['university.courses.*'])) active @endif">@lang('university::university.courses')</a>
                                        </li>

                                         <li class="nav-item">
                                            <a href="{{route('university.subjects.index')}}" class="nav-link @if(\Route::is(['university.subjects.*'])) active @endif">@lang('university::university.subjects')</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
