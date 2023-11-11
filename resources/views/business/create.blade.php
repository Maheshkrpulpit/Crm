@extends('layouts.master')
@section('title')
@lang('settings.business_settings')
@endsection
@section('css')
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ URL::asset('assets/libs/filepond/filepond.min.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') @lang( 'business.settings' ) @endslot
@slot('title')@lang( 'business.business_settings' ) @endslot
@endcomponent
<div class="row">

    @component('components.alert',['response'=>session('status')??[]])

    @endcomponent


    <!--end col-->
    <div class="col-xxl-12">

        <div class="card border card-border-primary">
            <div class=" card-body">

                <!-- Nav tabs -->
                <ul class="nav nav nav-tabs nav-tabs-custom nav-primary nav-justifiedmb-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#border-navs-business" role="tab">Business</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#border-navs-module" role="tab">Module</a>
                    </li>
                </ul><!-- Tab panes -->
                <div class="tab-content text-muted">

                    <!--Business Settings-->
                    <div class="tab-pane active" id="border-navs-business" role="tabpanel">

                        {!! Form::open(['url' => route('settings.business.store'), 'method' => 'post', 'id' => 'user_add_form','novalidate','class'=>'needs-validation' ,'enctype'=>'multipart/form-data','files'=>true]) !!}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">

                                    {!! Form::label('business_name', __( 'settings.business.business_name' ) . ':*') !!}
                                    {!! Form::text('business_name', $business_settings->business_name??'', ['class' => 'form-control', 'required', 'placeholder' => __( 'settings.business.business_name' ) ]) !!}

                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::label('business_title', __( 'settings.business.business_title' ) . ':*') !!}
                                    {!! Form::text('business_title', $business_settings->business_title??'', ['class' => 'form-control', 'required', 'placeholder' => __( 'settings.business.business_title' ) ]) !!}

                                    @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0"> {!! Form::label('logo',"Logo". ':*') !!}</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div>
                                            @if($logo)
                                            <!-- <img src="{{$logo}}" width="50"> -->
                                            @endif
                                        </div>
                                        {!! Form::file('logo', ['class' => 'form-control', 'placeholder' => __( 'logo' ),'data-allow-reorder'=>"true" ]) !!}

                                        @error('logo')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div> <!-- end col -->

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0"> {!! Form::label('icon',"Icon". ':*') !!}</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        {!! Form::file('icon', ['class' => 'form-control', 'placeholder' => __( 'icon' ),'data-allow-reorder'=>"true" ]) !!}

                                        @error('icon')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div> <!-- end col -->


                            <!--end col-->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::label('footer', __( 'settings.business.footer' ) . ':*') !!}
                                    {!! Form::text('footer', $business_settings->footer??'', ['class' => 'form-control', 'required', 'placeholder' => __( 'settings.business.footer' ) ]) !!}

                                    @error('footer')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <!--end col-->

                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-soft-success">Cancel</button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

                        {!! Form::close() !!}

                    </div>


                    <!--End Business Settings -->

                    <!-- Module Settings -->


                    <!-- End Settings -->

                </div>
            </div><!-- end card-body -->
        </div>
    </div><!--end col-->
</div>
<!--end row-->
@endsection
@section('script')

<script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>

<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection