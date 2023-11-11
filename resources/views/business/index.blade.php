@extends('layouts.master')
@section('title')
@lang('user.add_user')
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') @lang( 'settings::lang.settings.settings' ) @endslot
@slot('title')@lang( 'settings::lang.settings.business_settings' ) @endslot
@endcomponent


<div class="row">

    <!--end col-->
    <div class="col-xxl-9">
        <div class="card mt-xxl-n5">
            <div class="card-header">
                <h5 class="card-title mb-0">@lang( 'settings::lang.settings.business_settings' )</h5>
            </div>

            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="personalDetails" role="tabpanel">

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