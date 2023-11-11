@extends('layouts.master')
@section('title') @lang('locale.titles.manage_modules') @endsection
@section('css')
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />


@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') @lang( 'locale.breadcrumb.manage_modules' ) @endslot

@endcomponent

<!-- <div class="alert alert-danger" role="alert">
    This is <strong>Datatable</strong> page in wihch we have used <b>jQuery</b> with cnd link!
</div> -->


@component('components.alert',['response'=>session('status')??[]])

@endcomponent
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1>
                    <small>Only superadmin can access manage modules</small>
                </h1>
            </div>
            <div class="card-body">
                <button class="btn btn-sm btn-primary upload_module_btn mt-5">
                    <i class="fas fa-upload"></i>
                    @lang('locale.upload_module')
                </button>
                <div class="col-md-12 form_col" style="display: none;">
                    <div class="">
                        @php \URL::setRootControllerNamespace('App\Http\Controllers');@endphp
                        @component('components.widget')
                        {!! Form::open(['url' => action('Install\ModulesController@uploadModule'), 'id' => 'upload_module_form','files' => true, 'style' => 'display:none']) !!}
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    {!! Form::label('module', __('locale.labels.upload_module') . ":*") !!}

                                    {!! Form::file('module', ['required', 'accept' => 'application/zip']) !!}
                                    <p class="help-block">
                                        @lang("locale.labels.pls_upload_valid_zip_file")
                                    </p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    @lang('locale.buttons.upload')
                                </button>
                                &nbsp;
                                <button type="button" class="btn btn-danger btn-sm cancel_upload_btn">
                                    @lang('locale.buttons.cancel')
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        @endcomponent()
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    @component('components.widget')
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-striped-columns">
                            <thead class="table-light">
                                <tr class="success">
                                    <th class="col-md-1">#</th>
                                    <th class="col-md-4">@lang('locale.modules_string')</th>
                                    <th class="col-md-7">@lang('locale.description_string')</th>
                                </tr>
                            </thead>
                            @foreach($modules as $module)

                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    <strong>{{__(strtolower(str_replace(" ","_",$module['name'])))}}</strong> <br />
                                    @if(!$module['is_installed'])
                                    <a class="btn btn-success btn-xs" @if($is_demo) href="#" title="@lang('lang_v1.disabled_in_demo')" disabled @else href="{{$module['install_link']}}" @endif> @lang('locale.install')</a>
                                    @else
                                    <a class="btn btn-warning btn-xs" @if($is_demo) href="#" disabled title="@lang('locale.info_titles.disabled_in_demo')" @else href="{{$module['uninstall_link']}}" @endif onclick="return confirm('Do you really want to uninstall the module? Module will be uninstall but the data will not be deleted')">@lang('locale.uninstall')
                                    </a>

                                    {{-- Commented Activate/Deactivate
                                            @if($module['active'] == 1)
                                                <form
                                                    action="{{action('Install\ModulesController@update', ['module_name' => $module['name']])}}"
                                    style="display: inline;"
                                    method="post">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="action_type" value="deactivate">
                                    <button class="btn btn-warning btn-xs">@lang('locale.buttons.deactive')</button>
                                    </form>
                                    @else
                                    <form action="{{action('Install\ModulesController@update', ['module_name' => $module['name']])}}" style="display: inline;" method="post">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="action_type" value="activate">
                                        <button class="btn btn-success btn-xs">@lang('locale.buttons.activate')</button>
                                    </form>
                                    @endif
                                    --}}
                                    @endif

                                    <form action="{{action('Install\ModulesController@destroy',$module['name'])}}" style="display: inline;" method="post" onsubmit="return confirm('Do you really want to delete the module? Module code will be deleted but the data will not be deleted')">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-xs" @if($is_demo) disabled="disabled" title="@lang('locale.info_titles.disabled_in_demo')" @endif>
                                            @lang('locale.buttons.delete')</button>
                                    </form>
                                </td>

                                <td>
                                    {{$module['description']}} <br />
                                    @isset($module['version'])
                                    <small class="label bg-gray">@lang('locale.version') {{$module['version']['installed_version']}}</small>
                                    @endisset

                                    @if(!empty($module['version']) && $module['version']['is_update_available'])
                                    <div class="alert alert-warning mt-5">
                                        <i class="fas fa-sync"></i> @lang('locale.module_new_version', ['module' => $module['name'], 'link' => $module['update_link']])
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            @php
                            $mods = unserialize($mods);
                            $mods=[];
                            @endphp

                            @foreach($mods as $mod)
                            @if(!isset($modules[$mod['n']]))
                            <tr>
                                <td><i class="fas fa-hand-point-right fa-2x"></i></td>
                                <td>
                                    <strong>{{$mod['dn']}}</strong> <br />
                                    <button onclick="window.open('{{$mod['u']}}', '_blank')" class="btn btn-xs btn-success"><i class="fas fa-money-bill"></i> Buy</button>
                                </td>
                                <td>
                                    {{$mod['d']}}
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </table>
                    </div>
                    @endcomponent()
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    //show a hidden form on upload_module_btn click

    $(document).on('click', '.upload_module_btn', function() {
        $(".form_col,form#upload_module_form").fadeToggle();
    });

    //hide form on cancel_upload_btn click
    $(document).on('click', '.cancel_upload_btn', function() {
        $("form#upload_module_form")[0].reset();
        $(".form_col,form#upload_module_form").fadeOut();
    });
</script>
@endsection