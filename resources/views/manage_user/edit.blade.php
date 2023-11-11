@extends('layouts.master')
@section('title')
    @lang('locale.edit_user')
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') @lang( 'locale.manage_users' ) @endslot
@slot('title')@lang( 'locale.edit_user' ) @endslot
@endcomponent
<!--     <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img">
            <img src="{{ URL::asset('assets/images/profile-bg.jpg') }}" class="profile-wid-img" alt="">
            <div class="overlay-content">
                <div class="text-end p-3">
                    <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                        <input id="profile-foreground-img-file-input" type="file" class="profile-foreground-img-file-input">
                        <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light">
                            <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="row">
      
        <!--end col-->
        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
               <div class="card-header">
                <h5 class="card-title mb-0">@lang( 'locale.edit_user' )</h5>
            </div>
             <!--    <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i>
                                User Detail
                            </a>
                        </li>
                     
                      
                    </ul>
                </div> -->
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                       {!! Form::open(['url' => action('ManageUserController@update', [$user->id]), 'method' => 'PUT', 'id' => 'user_edit_form' ]) !!}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                          
                                                 {!! Form::label('name', __( 'locale.labels.name' ) . ':*') !!}
            {!! Form::text('name', $user->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'locale.labels.name' ) ]) !!}
                                          
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                          {!! Form::label('email', __( 'locale.labels.email' ) . ':*') !!}
            {!! Form::text('email', $user->email, ['class' => 'form-control', 'required', 'placeholder' => __( 'locale.labels.email' ) ]) !!}

            @error('email')
    <div class="text-danger">{{ $message }}</div>
@enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            {!! Form::label('phone',__("locale.labels.phone"). ':*') !!}
            {!! Form::text('phone',$user->phone, ['class' => 'form-control', 'required', 'placeholder' => __( 'locale.labels.phone' ) ]) !!}
               @error('phone')
    <div class="text-danger">{{ $message }}</div>
@enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                  
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            {!! Form::label('role', __( 'locale.labels.role' ) . ':*') !!} 
            {!! Form::select('role',[null=>__("locale.labels.role")]+$roles, !empty($user->roles->first()->id) ? $user->roles->first()->id : null, ['class' => 'form-control select2']) !!}
               @error('role')
    <div class="text-danger">{{ $message }}</div>
@enderror
                                        </div>
                                    </div>
                                    <!--end col-->

                                  
                                 
                                    <div class="col-lg-6">
                                        <div>
                                            {!! Form::label('password', __( 'locale.labels.password' ) . ':*') !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => __( 'locale.labels.password' ) ]) !!}
               @error('password')
    <div class="text-danger">{{ $message }}</div>
@enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6 mb-3">
                                        <div class="">
                                           {!! Form::label('confirm_password', __( 'locale.labels.confirm_password' ) . ':*') !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => __( 'locale.labels.confirm_password' ) ]) !!}
               @error('password_confirmation')
    <div class="text-danger">{{ $message }}</div>
@enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                 
                                 
                             
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">{{__('locale.buttons.save')}}</button>
                                            <button type="button" class="btn btn-soft-success">{{__('locale.buttons.save')}}</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
{!! Form::close() !!}

                        </div>
                       
       
                        <!--end tab-pane-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/pages/profile-setting.init.js') }}"></script>
        <script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
