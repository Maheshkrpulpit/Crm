@extends('layouts.master')
@section('title')
    {{lang('Add Language')}}
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') {{lang('Language')}} @endslot
        @slot('title'){{lang('Add Language')}} @endslot
    @endcomponent

    


    <div class="row">

        <!--end col-->
        <div class="col-xxl-9 w-50">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{lang( 'Add Language' )}}</h5>
                </div>

                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            {!! Form::open(['url' => route('settings.language.store'), 'method' => 'post', 'id' => 'hhj','novalidate','class'=>'needs-validation' ]) !!}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">

                                        {!! Form::label('name', lang( 'Name' ) . ':*') !!}
                                        {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => lang( 'Name' ) ]) !!}

                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3">

                                        {!! Form::label('code', lang( 'Code' ) . ':*') !!}
                                        {!! Form::text('code', null, ['class' => 'form-control', 'required', 'placeholder' => lang( 'Code' ) ]) !!}

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">

                                        {!! Form::label('file', lang( 'Image Upload' ) . ':*') !!}
                                        {!! Form::file('file', ['class' => 'form-control', 'id'=>'inputGroupFile01',  'required']) !!}

                                    </div>
                                </div>
                               
                                
                                <!-- Default File Input Example -->


                                <div class="col-lg-12">
                                    <div class="mb-3">


                                        <div class="form-check form-switch form-switch-lg" dir="ltr">

                                            <input type="checkbox" class="form-check-input" name="status"
                                                   id="customSwitchsizelg" value="1">
                                            <label class="form-check-label" for="customSwitchsizelg">{{lang('Status')}}</label>

                                        </div>

                                    </div>
                                </div>

                                <!--end col-->


                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary">{{lang('Save')}}</button>
                                        {{-- <button type="button" class="btn btn-soft-success">{{lang('Cancel')}}</button> --}}
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
