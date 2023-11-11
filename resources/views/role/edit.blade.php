@extends('layouts.master')
@section('title') @lang( 'role.edit_role' ) @endsection
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
@slot('li_1') @lang( 'role.edit_role' ) @endslot
@slot('title')@lang( 'user.manage_roles' ) @endslot
@endcomponent
<section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"></h3>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            {!! Form::label('name', __( 'user.role_name' ) . ':*') !!}
            {!! Form::label('name', __( 'user.role_name' ) . ':*') !!}
            {!! Form::text('name',$role->name , ['class' => 'form-control', 'required', 'placeholder' => __( 'user.role_name' ) ]) !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <label>@lang( 'user.permissions' ):</label>
        </div>
      </div>
    </div>
    <div class="card-body">
      @php
      $pos_settings = !empty(session('business.pos_settings')) ? json_decode(session('business.pos_settings'), true) : [];
      @endphp
      @component('components.widget', ['class' => 'box-primary'])
      {!! Form::open(['url' => action('RoleController@update', [$role->id]), 'method' => 'PUT', 'id' => 'role_form' ]) !!}

      <div class="row check_group">
        <div class="col-md-1">
          <h4>@lang( 'role.user' )</h4>
        </div>
        <div class="col-md-2">
          <div class="checkbox">
            <label>
              <input type="checkbox" class="check_all input-icheck"> {{ __( 'role.select_all' ) }}
            </label>
          </div>
        </div>
        <div class="col-md-9">
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('permissions[]', 'user.view', in_array('user.view', $role_permissions),
                [ 'class' => 'input-icheck']) !!} {{ __( 'role.user.view' ) }}
              </label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('permissions[]', 'user.create', in_array('user.create', $role_permissions),
                [ 'class' => 'input-icheck']) !!} {{ __( 'role.user.create' ) }}
              </label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('permissions[]', 'user.update', in_array('user.update', $role_permissions),
                [ 'class' => 'input-icheck']) !!} {{ __( 'role.user.update' ) }}
              </label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('permissions[]', 'user.delete', in_array('user.delete', $role_permissions),
                [ 'class' => 'input-icheck']) !!} {{ __( 'role.user.delete' ) }}
              </label>
            </div>
          </div>
        </div>
      </div>




      <hr>
      <div class="row check_group">
        <div class="col-md-1">
          <h4>@lang( 'user.roles' )</h4>
        </div>
        <div class="col-md-2">
          <div class="checkbox">
            <label>
              <input type="checkbox" class="check_all input-icheck"> {{ __( 'role.select_all' ) }}
            </label>
          </div>
        </div>
        <div class="col-md-9">
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('permissions[]', 'roles.view', in_array('roles.view', $role_permissions),
                [ 'class' => 'input-icheck']) !!} {{ __( 'lang_v1.view_role' ) }}
              </label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('permissions[]', 'roles.create', in_array('roles.create', $role_permissions),
                [ 'class' => 'input-icheck']) !!} {{ __( 'role.add_role' ) }}
              </label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('permissions[]', 'roles.update', in_array('roles.update', $role_permissions),
                [ 'class' => 'input-icheck']) !!} {{ __( 'role.edit_role' ) }}
              </label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('permissions[]', 'roles.delete', in_array('roles.delete', $role_permissions),
                [ 'class' => 'input-icheck']) !!} {{ __( 'lang_v1.delete_role' ) }}
              </label>
            </div>
          </div>
        </div>
      </div>
      <hr>


      @if(\Module::has('University'))

      @php $existingDirectory=[]; @endphp

      @foreach($permissions as $pIndex=> $permission)



      @php $fullDirectory=strstr($permission->name,".",true);



      $directoryName= str_replace('university_', '', $fullDirectory);




      @endphp

      @if(str_contains($fullDirectory,'university'))

      @if(!in_array($directoryName,$existingDirectory))

      @php $existingDirectory[]=$directoryName; @endphp





      <div class="row check_group">
        <div class="col-md-1">
          <h4>{{$directoryName}}</h4>
        </div>
        <div class="col-md-2">
          <div class="checkbox">
            <label>
              <input type="checkbox" class="check_all input-icheck"> {{ __( 'role.select_all' ) }}
            </label>
          </div>
        </div>
        <div class="col-md-9">
          @endif

          <div class="col-md-12">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('permissions[]', $permission->name, in_array($permission->name, $role_permissions),
                [ 'class' => 'input-icheck']) !!} {{ __(str_replace('university_','',$permission->name)) }}
              </label>
            </div>
          </div>



          @if(isset($permissions[$pIndex+1]))

          @php

          $nextDirectory=strstr($permissions[$pIndex+1]->name,".",true);
          $nextDirectory= str_replace('university_', '', $nextDirectory);

          @endphp

          @if($nextDirectory!=$directoryName)

        </div>

      </div>
      <hr>

      @endif

      @else
    </div>

  </div>
  <hr>

  @endif


  @endif

  @endforeach

  @endif




  <div class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary pull-right">@lang( 'messages.update' )</button>
    </div>
  </div>

  {!! Form::close() !!}
  @endcomponent
  </div>
  </div>
</section>

@endsection
@section('script')


<script type="text/javascript">
  $(document).ready(function() {



    $(document).on('change', '.check_all', function() {


      if ($(this).prop('checked')) {

        $(this).parents('.check_group').find('input').prop('checked', true);


      } else {
        $(this).parents('.check_group').find('input').prop('checked', false);
      }

    })
  });
</script>

@endsection