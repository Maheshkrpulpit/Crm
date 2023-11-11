@extends('layouts.master')
@section('title')
    {{lang('Edit Language')}}
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') {{lang('Language')}} @endslot
        @slot('title'){{lang('Edit Language')}} @endslot
    @endcomponent


    <div class="row">

        <!--end col-->
        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{lang('Edit Language')}} </h5>
                </div>

                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            {!! Form::open(['url' => route('settings.language.update',$language->id), 'method' => 'POST', 'id' => 'hhj','novalidate','class'=>'needs-validation' ]) !!}
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">

                                        {!! Form::textarea($language->code, $content, ['class' => 'form-control', 'required', 'placeholder' => __( 'user.name' ),'id'=>'language_source' ,'rows'=>'20']) !!}

                                    </div>
                                </div>


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

    <script type="text/javascript" src="{{  URL::asset('assets/js/ace/ace/ace.js') }}"></script>
    <script type="text/javascript" src="{{  URL::asset('assets/js/ace/ace/theme-twilight.js') }}"></script>
    <script type="text/javascript" src="{{  URL::asset('assets/js/ace/ace/mode-php.js')}}"></script>
    <script type="text/javascript" src="{{  URL::asset('assets/js/ace/ace/mode-yaml.js') }}"></script>
    <script type="text/javascript" src="{{  URL::asset('assets/js/ace/jquery-ace.js')}}"></script>

    <script type="text/javascript">
        $('#language_source').ace({theme: 'twilight', lang: 'yaml'});


    </script>
@endsection
