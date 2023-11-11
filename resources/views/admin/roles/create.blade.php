@extends('layouts.master')
@section('title') @lang('Role Management') @endsection
@section('content')
  @component('components.breadcrumb')
      @slot('li_1') @lang('Admin') @endslot
      @slot('li_2') @lang('Role') @endslot
      @slot('title')@lang('Add new') @endslot
  @endcomponent
  @component('components.alert',['response'=>session('status')??[]])@endcomponent
  <div class="row">
    <div class="col-lg-12">
        <div class="card border-top border-primary">
            <div class="card-header">
                <div class="align-items-center">
                    <h5 class="card-title">@lang('Add New Role')</h5>
                </div>                    
            </div>
            
            <div class="card-body">
              {!! Form::open(['url' =>route('admin.roles.store'),'method'=>'POST','id'=>'addRecordForm']) !!}
                <div class="row">
                  @include('admin.roles.partials.__form')  
                  @include('admin.roles.partials.__permission')  
                  <div class="col-12 text-end mt-3">
                      {!! Form::submit(trans('Submit'),['class' => 'addSubmit btn btn-primary']) !!}
                  </div>
                </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!--end col-->
  </div>
@endsection