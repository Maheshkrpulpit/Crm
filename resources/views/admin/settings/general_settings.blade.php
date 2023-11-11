@extends('layouts.master')
@section('title')
    {{ lang('General') }} {{ lang('Setting') }}
@endsection
@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ lang('Setting') }}
        @endslot
        @slot('title')
            {{ lang('General') }}
        @endslot
    @endcomponent

    @component('components.alert', ['response' => session('status') ?? []])
    @endcomponent


    <div class="col-xxl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="nav nav-pills flex-column nav-pills-tab custom-verti-nav-pills text-center"
                             role="tablist" aria-orientation="vertical">
                            <a class="nav-link active show" id="custom-v-pills-General_Setting-tab"
                               data-bs-toggle="pill"
                               href="#custom-v-pills-General_Setting" role="tab"
                               aria-controls="custom-v-pills-General_Setting"
                               aria-selected="true">{{ lang('General Setting') }}</a>
                            <a class="nav-link" id="custom-v-pills-Logo-tab" data-bs-toggle="pill"
                               href="#custom-v-pills-Logo" role="tab" aria-controls="custom-v-pills-Logo"
                               aria-selected="false">{{ lang('Logo') }}</a>

                            <a class="nav-link" id="custom-v-pills-login-tab" data-bs-toggle="pill"
                               href="#custom-v-pills-login" role="tab" aria-controls="custom-v-pills-login"
                               aria-selected="false">{{ lang('Login Page Background') }}</a>

                        </div>
                    </div> <!-- end col-->
                    <div class="col-md-10">
                        <div class="tab-content text-muted mt-3 mt-lg-0">
                            @include('admin.settings.partials.general')

                            @include('admin.settings.partials.logo')

                            @include('admin.settings.partials.login_background')
                        </div>
                    </div>
                </div> <!-- end col-->
            </div> <!-- end row-->
        </div><!-- end card-body -->
        @endsection
        @section('script')
            <script src="{{ asset('assets/js/pages/profile-setting.init.js') }}"></script>
            <script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
            <!-- ckeditor -->
            <script src="{{ asset('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
            <!-- init js -->
            <script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script>

            <!-- quill js -->
            <script src="{{ asset('assets/libs/quill/quill.min.js') }}"></script>

            <!-- App js -->
            <script src="{{ asset('assets/js/app.js') }}"></script>

            <script src="{{ asset('/assets/js/app.min.js') }}"></script>

            <script type="text/javascript">
                $(document).ready(function () {
                    $('#update_dark_logo').on('click', function () {
                        saveLogo('dark_logo');
                    });

                    $('#update_light_logo').on('click', function () {
                        saveLogo('light_logo');
                    });

                    $('#update_dark_logo_small').on('click', function () {
                        saveLogo('dark_logo_small');
                    });

                    $('#update_light_logo_small').on('click', function () {
                        saveLogo('light_logo_small');
                    });

                    $('#update_admin_login_background').on('click', function () {
                        saveLogo('admin_login_background');
                    });
                    $('#update_user_login_background').on('click', function () {
                        saveLogo('user_login_background');
                    });

                    function saveLogo(key) {
                        var error_ref = $("#" + key + "_error");
                        error_ref.html('');
                        error_ref.hide();
                        var formData = new FormData();
                        formData.append(key, $('#' + key)[0].files[0]);
                        formData.append('key', key);

                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url: '{{ route('settings.save_logo') }}',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            success: function (response) {
                                if (response.status == 1) {
                                    $("#" + key + "_image").attr("src", response.data);
                                    if (key == "dark_logo") {
                                        $("#sidebar_logo_dark").attr("src", response.data);
                                    }
                                    if (key == "light_logo") {
                                        $("#sidebar_logo_light").attr("src", response.data);
                                    }
                                } else {
                                    error_ref.html(response.message);
                                    error_ref.show();
                                }
                            },
                            error: function (res) {
                                res = res.responseJSON;
                                $.each(res.errors, function (i, error) {
                                    $('#' + i + '_error').html(error[0]);
                                    $('#' + i + '_error').show();
                                });
                            }
                        });
                    }
                });
            </script>
@endsection
