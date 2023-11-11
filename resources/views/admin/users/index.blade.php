@extends('layouts.master')
@section('title') @lang('User Management') @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') @lang('Admin') @endslot
        @slot('title')@lang('User') @endslot
    @endcomponent

    @component('components.alert',['response'=>session('status')??[]])@endcomponent

    <!--end row-->
    @can('user.access')
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-top border-primary" id="usersList">
                    <div class="card-header border-0">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title mb-0 flex-grow-1">@lang('Users List All')</h5>
                            <div class="flex-shrink-0">
                                <div class="d-flex flex-wrap gap-2">
                                    @can('user.create')
                                        <a href="javascript:void(0)" data-href="{{route('admin.users.create')}}" class="btn btn-info addRecordBtn">
                                           <i class="ri-add-line align-bottom me-1"></i> 
                                           {{lang('Add')}}
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        </div>                    
                    </div>

                    @include('admin.users.partials.__filters')
                    
                    <div class="card-body">
                        <div>
                            <div class="table-responsive table-card">
                                {{$dataTable->table(['class' => 'data-table table table-striped-columns table-bordered dt-responsive nowrap', 'style' => 'width:100%;'])}}
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