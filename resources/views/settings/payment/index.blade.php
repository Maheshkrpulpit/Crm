@extends('layouts.master')
@section('title')
@lang('locale.titles.payment_settings')
@endsection
@section('css')
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ URL::asset('assets/libs/filepond/filepond.min.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') @lang( 'locale.breadcrumb.settings' ) @endslot
@slot('title')@lang( 'locale.breadcrumb.payment_settings' ) @endslot
@endcomponent
<div class="row justify-content-center">

    @component('components.alert',['response'=>session('status')??[]])

    @endcomponent


    <!--end col-->
    <div class="card border card-border-primary">
        <div class="card-body">
            <div class="col-lg-12">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom nav-primary nav-justified mb-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link @if(isset($tab) && $tab=='flutterwave') active @endif" data-bs-toggle="tab" id="flutterwave" onclick="replaceUrl('flutterwave')" href="#border-navs-flutterwave" role="tab">{{__('locale.tabs.flutterwave')}}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if(isset($tab) && $tab=='atompay') active @endif" data-bs-toggle="tab" id="atompay" onclick="replaceUrl('atompay')" href="#border-navs-atompay" role="tab">{{__('locale.tabs.atompay')}}</a>
                    </li>
                </ul><!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--Payment Settings-->
                    @foreach($paymentGateways as $gateway)
                    @php
                    $gateway->options=json_decode($gateway->options);
                    ${strtolower($gateway->title)}=$gateway;
                    @endphp
                    @endforeach
                    <div class="tab-pane @if(isset($tab) && $tab=='flutterwave') active @endif" id="border-navs-flutterwave" role="tabpanel">
                        <div class="">
                            <div class="">
                                {!! Form::open(['url' => route('settings.payment.store'), 'method' => 'post', 'id' => 'user_add_form','novalidate','class'=>'needs-validation' ,'enctype'=>'multipart/form-data','files'=>true]) !!}
                                <input type="hidden" name="tab" value="flutterwave">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            {!! Form::label('FLW_PUBLIC_KEY', __( 'FLW_PUBLIC_KEY' ) . ':*') !!}
                                            {!! Form::text('FLW_PUBLIC_KEY', $flutterwave->options->FLW_PUBLIC_KEY??'', ['class' => 'form-control', 'required', 'placeholder' => __( 'FLW_PUBLIC_KEY' ) ]) !!}

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            {!! Form::label('FLW_SECRET_KEY', __( 'FLW_SECRET_KEY' ) . ':*') !!}
                                            {!! Form::text('FLW_SECRET_KEY', $flutterwave->options->FLW_SECRET_KEY??'', ['class' => 'form-control', 'required', 'placeholder' => __( 'FLW_SECRET_KEY' ) ]) !!}
                                            @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            {!! Form::label('FLW_SECRET_HASH', __( 'FLW_SECRET_HASH' ) . ':*') !!}
                                            {!! Form::text('FLW_SECRET_HASH', $flutterwave->options->FLW_SECRET_HASH??'', ['class' => 'form-control', 'required', 'placeholder' => __( 'FLW_SECRET_HASH' ) ]) !!}
                                            @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label></label>

                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                <input type="checkbox" class="form-check-input" name="status" id="customSwitchsizelg" @if(isset($flutterwave->status) && $flutterwave->status) checked @endif value="1">
                                                <label class="form-check-label" for="customSwitchsizelg">Status</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!--end col-->


                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label></label>

                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                <input type="checkbox" class="form-check-input" name="is_default" id="customSwitchsizelg" @if(isset($flutterwave->status) && $flutterwave->is_default) checked @endif value="1">
                                                <label class="form-check-label" for="customSwitchsizelg">@lang('locale.labels.set_as_default')</label>
                                            </div>
                                        </div>
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
                        </div>
                    </div>
                    <!--end Flutterwave -->




                    <!-- AtomPay -->


                    <div class="tab-pane @if(isset($tab) && $tab=='atompay') active @endif" id="border-navs-atompay" role="tabpanel">
                        <div class="">
                            <div class="">


                                {!! Form::open(['url' => route('settings.payment.store'), 'method' => 'post', 'id' => 'user_add_form','novalidate','class'=>'needs-validation']) !!}
                                <input type="hidden" name="tab" value="atompay">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">

                                            {!! Form::label('mode', __( 'locale.labels.mode' ) . ':*') !!}
                                            {!! Form::text('mode', $atompay->options->mode??'', ['class' => 'form-control', 'required', 'placeholder' => __( 'locale.placeholders.mode' ) ]) !!}


                                            @error('mode')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">

                                            {!! Form::label('client_code', __( 'locale.labels.client_code' ) . ':*') !!}
                                            {!! Form::text('client_code', $atompay->options->client_code??'', ['class' => 'form-control', 'required', 'placeholder' => __( 'locale.placeholders.client_code' ) ]) !!}


                                            @error('client_code')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            {!! Form::label('login', __( 'locale.labels.login' ) . ':*') !!}
                                            {!! Form::text('login', $atompay->options->login??'', ['class' => 'form-control', 'required', 'placeholder' => __( 'locale.placeholders.login' ) ]) !!}

                                            @error('login')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            {!! Form::label('password', __( 'password' ) . ':*') !!}
                                            {!! Form::text('password', $atompay->options->password??'', ['class' => 'form-control', 'required', 'placeholder' => __( 'locale.placeholders.password' ) ]) !!}

                                            @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            {!! Form::label('hash_request_key', __( 'locale.labels.hash_request_key' ) . ':*') !!}
                                            {!! Form::text('hash_request_key', $atompay->options->hash_request_key??'', ['class' => 'form-control', 'required', 'placeholder' => __( 'locale.placeholders.hash_request_key' ) ]) !!}

                                            @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            {!! Form::label('hash_response_key', __( 'locale.labels.hash_response_key' ) . ':*') !!}
                                            {!! Form::text('hash_response_key', $atompay->options->hash_response_key??'', ['class' => 'form-control', 'required', 'placeholder' => __( 'locale.placeholders.hash_response_key' ) ]) !!}

                                            @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->


                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label></label>

                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                <input type="checkbox" class="form-check-input" name="status" id="customSwitchsizelg" @if(isset($atompay->status) && $atompay->status) checked @endif value="1">
                                                <label class="form-check-label" for="customSwitchsizelg">@lang('locale.labels.status')</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!--end col-->


                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label></label>

                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                <input type="checkbox" class="form-check-input" name="is_default" id="customSwitchsizelg" @if(isset($atompay->status) && $atompay->is_default) checked @endif value="1">
                                                <label class="form-check-label" for="customSwitchsizelg">@lang('locale.labels.set_as_default')</label>
                                            </div>
                                        </div>
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
                        </div>

                    </div>


                    <!--end Atompay-->
                </div>
            </div><!--end col-->
        </div>
    </div>
</div>
<!--end row-->
@endsection
@section('script')

<script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>

<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script type="text/javascript">
    function replaceUrl(tab) {
        var newurl = '{{route("settings.payment.index")}}' + '/' + tab;
        window.history.pushState({
            path: newurl
        }, '', newurl);
    }


    window.addEventListener('popstate', function(event) {
        // The popstate event is fired each time when the current history entry changes.
        var tab = window.location.pathname.split("/").pop();


        if (tab == 'business' || tab == 'module') {

            window.location = '{{route("settings.payment.index")}}' + '/' + tab;
        } else {
            window.location = document.referrer;

            //  history.back();
        }

    }, false);

    history.pushState(null, null, window.location.pathname);
</script>
@endsection