@extends('layouts.master')
@section('title')
    @lang('locale.titles.business_settings')
@endsection

@section('css')
    <link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/filepond/filepond.min.css') }}" type="text/css" />
    <link rel="stylesheet"
        href="{{ URL::asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            @lang('locale.breadcrumb.settings')
        @endslot
        @slot('title')
            @lang('locale.breadcrumb.business_settings')
        @endslot
    @endcomponent
    <div class="row justify-content-center">
        @component('components.alert', ['response' => session('status') ?? []])
        @endcomponent
        <div class="row">
            <!--end col-->
            <div class="col-lg-12">
                <div class="card border card-border-primary">
                    <div class=" card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom nav-primary nav-justified mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link @if (isset($tab) && $tab == 'module') active @endif" data-bs-toggle="tab"
                                    id="module" @if (isset($tab) && $tab == 'module') area-selected="true" @endif
                                    onclick="replaceUrl('module')" href="#border-navs-module"
                                    role="tab">@lang('locale.tabs.module')</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link @if (isset($tab) && $tab == 'email') active @endif" data-bs-toggle="tab"
                                    id="email" @if (isset($tab) && $tab == 'email') area-selected="true" @endif
                                    onclick="replaceUrl('email')" href="#border-navs-email"
                                    role="tab">@lang('locale.tabs.email')</a>
                            </li>

                        </ul><!-- Tab panes -->
                        <div class="tab-content text-muted">
                            <!-- Module Settings -->
                            <div class="tab-pane @if (isset($tab) && $tab == 'module') active @endif" id="border-navs-module"
                                role="tabpanel">

                                {!! Form::open([
                                    'url' => route('settings.module.store'),
                                    'method' => 'post',
                                    'id' => 'module_form',
                                    'novalidate',
                                    'class' => 'needs-validation',
                                ]) !!}

                                <div class="row">

                                    @if (isset($___sideBarMenu) && count($___sideBarMenu))
                                        @foreach ($___sideBarMenu as $sb_key => $sidebarItem)
                                            @if (isset($sidebarItem['code']))
                                                @php$codeDetail = explode('__', $sidebarItem['code']);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     $isModuleEnabled = '';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      $$module__item__name = ucwords(str_replace('_', ' ', $codeDetail[2]));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        if (isset($module_settings) && count($module_settings)):
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        if (in_array($sidebarItem['code'], $module_settings)):
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       $isModuleEnabled = 'checked';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        endif;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         endif;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            @endphp ?> ?> ?> ?> ?> ?> ?> ?> ?> ?> ?> ?> ?> ?> ?> ?> ?> ?> ?> ?>
                                                ?>


                                                <div class="col-md-4 mt-3">

                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                        <input type="checkbox" class="form-check-input" name="modules[]"
                                                            id="customSwitchsizelg" {{ $isModuleEnabled }}
                                                            value="{{ $sidebarItem['code'] }}">
                                                        <label class="form-check-label"
                                                            for="customSwitchsizelg">{{ __('locale.modules.' . strtolower(str_replace(' ', '_', $module__item__name))) }}</label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    <div class="col-lg-12 mt-5">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">@lang('locale.buttons.save')</button>
                                            <button type="button" class="btn btn-soft-success">@lang('locale.buttons.cancel')</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <input type="hidden" name="tab" value="module">
                                    {!! Form::close() !!}

                                </div>
                            </div>
                            <!-- End Settings -->
                            <!--Email Settings-->
                            <div class="tab-pane @if (isset($tab) && $tab == 'email') active @endif" id="border-navs-email"
                                role="tabpanel">

                                {!! Form::open([
                                    'url' => route('settings.email.settings'),
                                    'method' => 'post',
                                    'id' => 'user_add_form',
                                    'novalidate',
                                    'class' => 'needs-validation',
                                    'enctype' => 'multipart/form-data',
                                    'files' => true,
                                ]) !!}
                                <input type="hidden" name="tab" value="email">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            {!! Form::label('mail_from_name', __('locale.labels.mail_from_name') . ':*') !!}
                                            {!! Form::text('mail_from_name', $email_settings->mail_from_name ?? '', [
                                                'class' => 'form-control',
                                                'required',
                                                'placeholder' => __('locale.labels.mail_from_name'),
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            {!! Form::label('mail_host', __('locale.labels.mail_host') . ':*') !!}
                                            {!! Form::text('mail_host', $email_settings->mail_host ?? '', [
                                                'class' => 'form-control',
                                                'required',
                                                'placeholder' => __('locale.labels.mail_host'),
                                            ]) !!}

                                            @error('mail_host')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            {!! Form::label('mail_username', __('locale.labels.mail_username') . ':*') !!}
                                            {!! Form::text('mail_username', $email_settings->mail_username ?? '', [
                                                'class' => 'form-control',
                                                'required',
                                                'placeholder' => __('locale.labels.mail_username'),
                                            ]) !!}

                                            @error('mail_username')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            {!! Form::label('mail_password', __('locale.labels.mail_password') . ':*') !!}
                                            {!! Form::text('mail_password', $email_settings->mail_password ?? '', [
                                                'class' => 'form-control',
                                                'required',
                                                'placeholder' => __('locale.labels.mail_password'),
                                            ]) !!}

                                            @error('mail_password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            {!! Form::label('mail_port', __('locale.labels.mail_port') . ':*') !!}
                                            {!! Form::text('mail_port', $email_settings->mail_port ?? '', [
                                                'class' => 'form-control',
                                                'required',
                                                'placeholder' => __('locale.labels.mail_port'),
                                            ]) !!}

                                            @error('mail_port')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            {!! Form::label('mail_encryption', __('locale.labels.mail_encryption') . ':*') !!}
                                            {!! Form::text('mail_encryption', $email_settings->mail_encryption ?? '', [
                                                'class' => 'form-control',
                                                'required',
                                                'placeholder' => __('locale.labels.mail_encryption'),
                                            ]) !!}

                                            @error('mail_encryption')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">@lang('locale.buttons.save')</button>
                                            <button type="button" class="btn btn-soft-success">@lang('locale.buttons.cancel')</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                                {!! Form::close() !!}

                            </div>
                            <!--End Email Settings -->
                        </div>
                    </div><!-- end card-body -->
                </div>
            </div><!--end col-->
        </div>
        <!--end row-->
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script type="text/javascript">
        function replaceUrl(tab) {
            var newurl = '{{ route('settings.index') }}' + '/' + tab;
            window.history.pushState({
                path: newurl
            }, '', newurl);
        }


        window.addEventListener('popstate', function(event) {
            // The popstate event is fired each time when the current history entry changes.
            var tab = window.location.pathname.split("/").pop();


            if (tab == 'business' || tab == 'module') {

                window.location = '{{ route('settings.index') }}' + '/' + tab;
            } else {
                window.location = document.referrer;

                //  history.back();
            }

        }, false);

        history.pushState(null, null, window.location.pathname);
    </script>
@endsection
