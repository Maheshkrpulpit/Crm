@extends('layouts.master')
@section('title') {{lang('Fields Management')}} @endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/@simonwep/pickr/themes/classic.min.css') }}" /> <!-- 'classic' theme -->
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/@simonwep/pickr/themes/monolith.min.css') }}" /> <!-- 'monolith' theme -->
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}" /> <!-- 'nano' theme -->
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') {{lang( 'Settings' )}} @endslot
        @slot('title'){{lang( 'Fields' )}} @endslot
    @endcomponent

    @component('components.alert',['response'=>session('status')??[]])@endcomponent

    <!--end row-->
    {{-- @can('system_fields.access') --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-top border-primary" id="invoiceList">
                    <div class="card-header border border-dashed ">
                        <div class="d-flex align-items-center">
                            <div class="row flex-grow-1 g-3">
                                <div class="col-xxl-11 col-sm-12">
                                    <div class="search-box">
                                        <input type="text" id="searchTableInput"
                                               class="form-control search bg-light border-light"
                                               placeholder="{{lang('Searching...')}}">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="d-flex gap-2 flex-wrap">
                                    {{-- @can('system_fields.delete') --}}
                                        <button class="btn btn-primary" id="remove-actions" onClick="deleteMultiple()">
                                            <i class="ri-delete-bin-2-line"></i></button>
                                    {{-- @endcan --}}

                                    {{-- @can('system_fields.access') --}}
                                        <a href="javascript:void(0)"
                                           data-href="{{route('settings.system-fields.create')}}"
                                           class="btn btn-info addRecordBtn"><i
                                                    class="ri-add-line align-bottom me-1"></i> {{lang('Add')}}
                                        </a>
                                    {{-- @endcan --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="table-responsive table-card">
                                {{$dataTable->table(['class' => 'table table-striped-columns table-bordered dt-responsive nowrap', 'style' => 'width:100%;'])}}
                            </div>
                        </div>
                        <div class="popup_render_div"></div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
    {{-- @endcan --}}
@endsection

@section('script')
        <script src="{{ URL::asset('assets/libs/@simonwep/pickr/pickr.min.js')}}"></script>
       
        
    {!! $dataTable->scripts() !!}
    @include('admin.settings.systemFields.partials.__script')

@endsection