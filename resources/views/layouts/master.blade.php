<?php
use Illuminate\Support\Facades\URL;
$themeConfigs = isset(auth()->user()->theme->config) ? (array)json_decode(auth()->user()->theme->config) : '';
//dd($themeConfigs);
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="{{$themeConfigs['data-layout'] ?? 'vertical'}}" data-sidebar="{{$themeConfigs['data-sidebar'] ?? 'light'}}" data-sidebar-size="{{$themeConfigs['data-sidebar-size'] ?? 'lg'}}" data-sidebar-image="{{$themeConfigs['data-sidebar-image'] ?? 'none'}}" data-preloader="{{$themeConfigs['data-preloader'] ?? 'disable'}}" data-topbar="{{$themeConfigs['data-topbar'] ?? 'light'}}" data-layout-style="{{$themeConfigs['data-layout-style'] ?? 'default'}}" data-bs-theme="{{$themeConfigs['data-bs-theme'] ?? 'light'}}" data-layout-width="{{$themeConfigs['data-layout-width'] ?? 'fluid'}}" data-layout-position="{{$themeConfigs['data-layout-position'] ?? 'fixed'}}">

<head>
    <meta charset="utf-8"/>
    <title>@yield('title') | {{ get_general_setting('school_name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="UMIS" name="pulpitdma.com"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->

    <link rel="shortcut icon" href="{{$icon ?? asset('assets/images/favicon.ico') }}">
    @include('layouts.head-css')
</head>

<body>
<!-- Begin page -->
<div id="layout-wrapper">
@include('layouts.topbar')
@include('layouts.sidebar')
<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @yield('content')
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        @include('layouts.footer')
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

@include('layouts.customizer')

<!-- JAVASCRIPT -->
@include('layouts.vendor-scripts')
</body>

</html>