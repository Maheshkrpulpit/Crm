<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index" class="logo logo-dark">
                        <span class="logo-sm">
                            <h2 class="text-white">{{ get_general_setting('school_name') }}</h2>
                        </span>
                        <span class="logo-lg">
                            <h2 class="text-white">{{ $business->business_title ?? '' }}</h2>
                        </span>
                    </a>

                    <a href="index" class="logo logo-light">
                        <span class="logo-sm">
                            <h2 class="text-white">{{ $business->business_title ?? '' }}</h2>
                        </span>
                        <span class="logo-lg">
                            <h2 class="text-white">{{ $business->business_title ?? '' }}</h2>
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                        id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-md-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search..." autocomplete="off"
                               id="search-options" value="">
                        <span class="mdi mdi-magnify search-widget-icon"></span>
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                              id="search-close-options"></span>
                    </div>
                    <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                        <div data-simplebar style="max-height: 320px;">
                            <!-- item-->
                            <div class="dropdown-header">
                                <h6 class="text-overflow text-muted mb-0 text-uppercase">Recent Searches</h6>
                            </div>

                            <div class="dropdown-item bg-transparent text-wrap">
                                <a href="index" class="btn btn-soft-secondary btn-sm btn-rounded">how to setup <i
                                            class="mdi mdi-magnify ms-1"></i></a>
                                <a href="index" class="btn btn-soft-secondary btn-sm btn-rounded">buttons <i
                                            class="mdi mdi-magnify ms-1"></i></a>
                            </div>
                            <!-- item-->
                            <div class="dropdown-header mt-2">
                                <h6 class="text-overflow text-muted mb-1 text-uppercase">Pages</h6>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-bubble-chart-line align-middle fs-18 text-muted me-2"></i>
                                <span>Analytics Dashboard</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-lifebuoy-line align-middle fs-18 text-muted me-2"></i>
                                <span>Help Center</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                                <span>My account settings</span>
                            </a>

                            <!-- item-->
                            <div class="dropdown-header mt-2">
                                <h6 class="text-overflow text-muted mb-2 text-uppercase">Members</h6>
                            </div>

                            <div class="notification-list">
                                <!-- item -->
                                <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                    <div class="d-flex">
                                        <img src="{{ URL::asset('assets/images/users/avatar-2.jpg') }}"
                                             class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-1">
                                            <h6 class="m-0">Angela Bernier</h6>
                                            <span class="fs-11 mb-0 text-muted">Manager</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- item -->
                                <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                    <div class="d-flex">
                                        <img src="{{ URL::asset('assets/images/users/avatar-3.jpg') }}"
                                             class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-1">
                                            <h6 class="m-0">David Grasso</h6>
                                            <span class="fs-11 mb-0 text-muted">Web Designer</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- item -->
                                <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                    <div class="d-flex">
                                        <img src="{{ URL::asset('assets/images/users/avatar-5.jpg') }}"
                                             class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-1">
                                            <h6 class="m-0">Mike Bunch</h6>
                                            <span class="fs-11 mb-0 text-muted">React Developer</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="text-center pt-3 pb-1">
                            <a href="pages-search-results" class="btn btn-primary btn-sm">View All Results <i
                                        class="ri-arrow-right-line ms-1"></i></a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown d-md-none topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                            id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                         aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..."
                                           aria-label="Recipient's username">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if (\Module::has('University') && \Route::is('university.*'))
                    <div class="ms-1 header-item d-none d-sm-flex">
                        <div class="dropdown">
                            @foreach (\Modules\University\Entities\SessionSetting::pluck('session', 'id')->toArray() as $sess_id => $session)
                                @phpif (!session('global_session_year')):
                                get_saved_session();
                                endif;
                                @endphp ?> ?> ?>
                                @if (session('global_session_year') && $sess_id == session('global_session_year'))
                                    <a href="#" class="btn btn-secondary dropdown-toggle"
                                       data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ $session }}
                                        @php $set=1 @endphp
                                    </a>
                                    @break
                                @endif
                            @endforeach

                            @if (!isset($set))
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    Session
                                </a>
                            @endif
                            <div class="dropdown-menu">
                                @foreach (\Modules\University\Entities\SessionSetting::pluck('session', 'id')->toArray() as $sess_id => $session)
                                    <a class="dropdown-item"
                                       href="{{ url('university/set/session/' . $sess_id) }}">{{ $session }}</a>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="ms-1 header-item d-none d-sm-flex">
                        <div class="dropdown">
                            @foreach (\Modules\University\Entities\ProgramType::pluck('name', 'id')->toArray() as $program_id => $program_name)
                                @phpif (!session('current_program_type')):
                                session(['current_program_type' => $program_id]);
                                endif;
                                @endphp ?> ?> ?>
                                @if (session('current_program_type') && $program_id == session('current_program_type'))
                                    <a href="#" class="btn btn-secondary dropdown-toggle"
                                       data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ $program_name }}
                                        @php $set=1 @endphp
                                    </a>
                                    @break
                                @endif
                            @endforeach

                            @if (!isset($set))
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    @lang('locale.labels.program_type')
                                </a>
                            @endif
                            <div class="dropdown-menu">
                                @foreach (\Modules\University\Entities\ProgramType::pluck('name', 'id')->toArray() as $program_id => $program_name)
                                    <a class="dropdown-item"
                                       href="{{ url('university/set/program/' . $program_id) }}">{{ $program_name }}</a>
                                @endforeach

                            </div>
                        </div>
                    </div>
                @endif
                <div class="ms-1 header-item d-none d-sm-flex">
                    <span class="badge rounded-pill border border-primary text-Time"></span>
                    <span class="badge badge-label bg-secondary"><i class="mdi mdi-circle-medium"></i> {{get_time(get_general_setting('timezone'))}}</span>
                </div>
                <div class="dropdown ms-1 topbar-head-dropdown header-item">
                    <form method="post" id="topbar_language_form" action="{{ route('settings.general_save') }}">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle pt-1"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ URL::asset('assets/images/flags/us.svg')}}" id="selected-language-image"
                                 alt="Header Language"
                                 height="20" class="rounded">
                        </button>

                        <div class="dropdown-menu dropdown-menu-end">
                            
                        @foreach (get_languages() as $language)
                            <!-- item-->
                                <a href="javascript:submitform('{{$language['code']}}')"
                                   class="dropdown-item notify-item language py-2"
                                   data-lang="en" title="{{ $language['name'] }}">
                                    <img src="{{ URL::asset('assets/images/flags/us.svg')}}" alt="user-image"
                                         class="me-2 rounded"
                                         height="18">
                                    <span class="align-middle" value="{{ $language['code'] }}"
                                @if (get_general_setting('default_language') == $language['code']) {{ 'selected' }} @endif>{{ $language['name'] }}</span>
                                </a>
                            @endforeach

                        </div>
                    </form>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                            data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                            class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                @if (\Module::has('Office') && \Schema::hasTable('user_notifications'))

                    @php

                        $allUserNotificationsCount = auth()
                            ->user()
                            ->notifications()
                            ->count();
                        $unreadNotifications = auth()
                            ->user()
                            ->notifications()
                            ->where('is_read', 0)
                            ->get();

                    @endphp

                    <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                            <i class='bx bx-bell fs-22'></i>
                            <span
                                    class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{ count($unreadNotifications) }}<span
                                        class="visually-hidden">unread messages</span></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                             aria-labelledby="page-header-notifications-dropdown">

                            <div class="dropdown-head bg-primary bg-pattern rounded-top">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                        </div>
                                        <div class="col-auto dropdown-tabs">
                                    <span class="badge badge-soft-light fs-13">
                                        {{ count($unreadNotifications) }} New</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-2 pt-2">
                                    <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
                                        id="notificationItemsTab" role="tablist">
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab"
                                               role="tab" aria-selected="true">
                                                All ({{ $allUserNotificationsCount }})
                                            </a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" data-bs-toggle="tab" href="#messages-tab"
                                               role="tab" aria-selected="false">
                                                Messages
                                            </a>
                                        </li>
                                        <li class="nav-item waves-effect waves-light">
                                            <a class="nav-link" data-bs-toggle="tab" href="#alerts-tab"
                                               role="tab" aria-selected="false">
                                                Alerts
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <div class="tab-content position-relative" id="notificationItemsTabContent">
                                <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                    <div data-simplebar style="max-height: 300px;" class="pe-2">

                                        @foreach ($unreadNotifications as $notification)
                                            <div
                                                    class="text-reset notification-item d-block dropdown-item position-relative">
                                                <div class="d-flex">
                                                    <div class="avatar-xs me-3">
                                                <span
                                                        class="avatar-title bg-soft-info text-info rounded-circle fs-16">
                                                    <i class="bx bx-badge-check"></i>
                                                </span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <a href="#!" class="stretched-link">
                                                            {{ $notification->notification->message ?? '' }}
                                                        </a>
                                                        <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i>
                                                        {{ $notification->created_at->diffForHumans() }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="px-2 fs-15">
                                                        <div class="form-check notification-check">
                                                            <input class="form-check-input topNotifications"
                                                                   type="checkbox" value="{{ $notification->id }}"
                                                                   name="readnotifications[]"
                                                                   id="all-notification-check{{ $notification->id }}">
                                                            <label class="form-check-label"
                                                                   for="all-notification-check{{ $notification->id }}"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach

                                        <div class="my-3 text-center view-all">
                                            <button type="button"
                                                    class="btn btn-soft-success waves-effect waves-light">
                                                View
                                                All Notifications <i class="ri-arrow-right-line align-middle"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane fade py-2 ps-2" id="messages-tab" role="tabpanel"
                                     aria-labelledby="messages-tab">
                                    <div data-simplebar style="max-height: 300px;" class="pe-2">
                                        <div class="text-reset notification-item d-block dropdown-item">
                                            <div class="d-flex">
                                                <img src="{{ URL::asset('assets/images/users/avatar-3.jpg') }}"
                                                     class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                <div class="flex-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">James Lemire</h6>
                                                    </a>
                                                    <div class="fs-13 text-muted">
                                                        <p class="mb-1">We talked about a project on linkedin.</p>
                                                    </div>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> 30 min ago</span>
                                                    </p>
                                                </div>
                                                <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               value="" id="messages-notification-check01">
                                                        <label class="form-check-label"
                                                               for="messages-notification-check01"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-reset notification-item d-block dropdown-item">
                                            <div class="d-flex">
                                                <img src="{{ URL::asset('assets/images/users/avatar-2.jpg') }}"
                                                     class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                <div class="flex-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">Angela Bernier</h6>
                                                    </a>
                                                    <div class="fs-13 text-muted">
                                                        <p class="mb-1">Answered to your comment on the cash flow
                                                            forecast's
                                                            graph 🔔.</p>
                                                    </div>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> 2 hrs ago</span>
                                                    </p>
                                                </div>
                                                <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               value="" id="messages-notification-check02">
                                                        <label class="form-check-label"
                                                               for="messages-notification-check02"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-reset notification-item d-block dropdown-item">
                                            <div class="d-flex">
                                                <img src="{{ URL::asset('assets/images/users/avatar-6.jpg') }}"
                                                     class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                <div class="flex-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">Kenneth Brown</h6>
                                                    </a>
                                                    <div class="fs-13 text-muted">
                                                        <p class="mb-1">Mentionned you in his comment on 📃 invoice
                                                            #12501.
                                                        </p>
                                                    </div>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> 10 hrs ago</span>
                                                    </p>
                                                </div>
                                                <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               value="" id="messages-notification-check03">
                                                        <label class="form-check-label"
                                                               for="messages-notification-check03"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-reset notification-item d-block dropdown-item">
                                            <div class="d-flex">
                                                <img src="{{ URL::asset('assets/images/users/avatar-8.jpg') }}"
                                                     class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                <div class="flex-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">Maureen Gibson</h6>
                                                    </a>
                                                    <div class="fs-13 text-muted">
                                                        <p class="mb-1">We talked about a project on linkedin.</p>
                                                    </div>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> 3 days ago</span>
                                                    </p>
                                                </div>
                                                <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               value="" id="messages-notification-check04">
                                                        <label class="form-check-label"
                                                               for="messages-notification-check04"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="my-3 text-center view-all">
                                            <button type="button"
                                                    class="btn btn-soft-success waves-effect waves-light">
                                                View
                                                All Messages <i class="ri-arrow-right-line align-middle"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade p-4" id="alerts-tab" role="tabpanel"
                                     aria-labelledby="alerts-tab"></div>

                                <div class="notification-actions" id="notification-actions">
                                    <div class="d-flex text-muted justify-content-center">
                                        Select
                                        <div id="select-content" class="text-body fw-semibold px-1">0</div>
                                        Result
                                        <button type="button" class="btn btn-link link-danger p-0 ms-3"
                                                data-bs-toggle="modal" data-bs-target="#removeNotificationModal">Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            @endif

            <!--notifications end -->

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                <span class="d-flex align-items-center">
                    <img class="rounded-circle header-profile-user"
                         src="@if (Auth::user()->avatar != '') {{ URL::asset('images/' . Auth::user()->avatar) }}@else{{ URL::asset('assets/images/users/avatar-1.jpg') }} @endif"
                         alt="Header Avatar">
                    <span class="text-start ms-xl-2">
                        <span
                                class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ Auth::user()->name ?? '' }}</span>
                        <span
                                class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{ Auth::user()->roles->first()->name ?? '' }}</span>
                    </span>
                </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome {{ Auth::user()->name ?? '' }}!</h6>
                        <a class="dropdown-item" href="{{ route('user.profile') }}"><i
                                    class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle">Profile</span></a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="auth-lockscreen-basic"><i
                                    class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span
                                    class="align-middle">Lock screen</span></a>
                        <a class="dropdown-item " href="javascript:void();"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                    class="bx bx-power-off font-size-16 align-middle me-1"></i> <span
                                    key="t-logout">@lang('locale.translation.logout')</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</header>

<!-- removeNotificationModal -->
<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                               colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete
                        It!
                    </button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->