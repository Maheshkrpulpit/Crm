@extends('layouts.master')
@section('title') @lang( 'locale.add_role' ) @endsection
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
@slot('li_1') @lang( 'locale.add_role' ) @endslot
@slot('title')@lang( 'locale.manage_roles' ) @endslot
@endcomponent
<section class="content">
    @php
      $pos_settings = !empty(session('business.pos_settings')) ? json_decode(session('business.pos_settings'), true) : [];
    @endphp
    @component('components.widget', ['class' => 'box-primary'])
        {!! Form::open(['url' => action('RoleController@store'), 'method' => 'post', 'id' => 'role_add_form' ]) !!}
        <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            {!! Form::label('name', __( 'locale.labels.role_name' ) . ':*') !!}
              {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'locale.labels.role_name' ) ]) !!}
          </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-3">
          <label>@lang( 'locale.labels.permissions' ):</label> 
        </div>
        </div>

       <hr>

        <div class="row check_group">
        <div class="col-md-1">
          <h4>@lang( 'locale.user' )</h4>
        </div>
        <div class="col-md-2">
          <div class="checkbox">
              <label>
                <input type="checkbox" class="check_all input-icheck" > {{ __( 'locale.labels.select_all' ) }}
              </label>
            </div>
        </div>
        <div class="col-md-9">
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('permissions[]', 'user.view', false, 
                [ 'class' => 'input-icheck']) !!} {{ __( 'role.user.view' ) }}
              </label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('permissions[]', 'user.create', false, 
                [ 'class' => 'input-icheck']) !!} {{ __( 'role.user.create' ) }}
              </label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('permissions[]', 'user.update', false, 
                [ 'class' => 'input-icheck']) !!} {{ __( 'role.user.update' ) }}
              </label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('permissions[]', 'user.delete', false, 
                [ 'class' => 'input-icheck']) !!} {{ __( 'role.user.delete' ) }}
              </label>
            </div>
          </div>
        </div>
        </div>




        <hr>
        <div class="row check_group">
        <div class="col-md-1">
          <h4>@lang( 'locale.roles' )</h4>
        </div>
        <div class="col-md-2">
          <div class="checkbox">
              <label>
                <input type="checkbox" class="check_all input-icheck" > {{ __( 'role.select_all' ) }}
              </label>
            </div>
        </div>
        <div class="col-md-9">
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('permissions[]', 'roles.view', false, 
                [ 'class' => 'input-icheck']) !!} {{ __( 'lang_v1.view_role' ) }}
              </label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('permissions[]', 'roles.create', false, 
                [ 'class' => 'input-icheck']) !!} {{ __( 'role.add_role' ) }}
              </label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('permissions[]', 'roles.update', false, 
                [ 'class' => 'input-icheck']) !!} {{ __( 'role.edit_role' ) }}
              </label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('permissions[]', 'roles.delete', false, 
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
          <h4>{{ucwords(__($directoryName))}}</h4>
        </div>
        <div class="col-md-2">
          <div class="checkbox">
              <label>
                <input type="checkbox" class="check_all input-icheck" > {{ __( 'role.select_all' ) }}
              </label>
            </div>
        </div>
 <div class="col-md-9">
        @endif
       
          <div class="col-md-12">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('permissions[]', $permission->name, false, 
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
           <button type="submit" class="btn btn-primary pull-right">@lang( 'locale.buttons.save' )</button>
        </div>
        </div>

        {!! Form::close() !!}
    @endcomponent
</section>

@endsection
@section('script')


<script type="text/javascript">

    $(document).ready(function(){



                $(document).on('change','.check_all',function(){


                  if($(this).prop('checked')){

                     $(this).parents('.check_group').find('input').prop('checked',true);


                  }
                  else
                  {
                     $(this).parents('.check_group').find('input').prop('checked',false);
                  }

                })
    });

</script>

@endsection
