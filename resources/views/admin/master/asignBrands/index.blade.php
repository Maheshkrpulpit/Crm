@extends('layouts.master')
@section('title') @lang('Asign Brands') @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') @lang('Admin') @endslot
        @slot('li_2') @lang('Master') @endslot
        @slot('title')@lang('Asign Brands') @endslot
    @endcomponent
    @component('components.alert',['response'=>session('status')??[]])@endcomponent
@can('asign_brands.access')
    
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-top border-primary" id="invoiceList">
                    <div class="card-header border border-dashed ">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title mb-0 flex-grow-1">@lang('Asign Brand List All')</h5>
                            <div class="flex-shrink-0">
                                <div class="d-flex gap-2 flex-wrap">
                                    @can('asign_brands.delete')
                                        <button class="btn btn-primary" id="remove-actions" onClick="deleteMultiple()">
                                            <i class="ri-delete-bin-2-line"></i></button>
                                    @endcan
        
                                    @can('asign_brands.access')
                                        <a href="javascript:void(0)"
                                           data-href="{{ route('admin.asign-brands.create', ['user_id' => $user_id]) }}"
                                           class="btn btn-info addRecordBtn"><i
                                                    class="ri-add-line align-bottom me-1"></i> {{lang('Add Asign Brand')}}
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('admin.master.partials.__filters')
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
@endcan
@endsection 
@section('script')
{!! $dataTable->scripts() !!}
@include('admin.master.partials.__script') 
@endsection                       

